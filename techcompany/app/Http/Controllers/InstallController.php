<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class InstallController extends Controller
{
    /**
     * Show the installation welcome page
     */
    public function index()
    {
        return view('install.welcome');
    }

    /**
     * Show the requirements check page
     */
    public function requirements()
    {
        $requirements = [
            'php' => [
                'name' => 'PHP Version >= 8.1',
                'status' => version_compare(PHP_VERSION, '8.1.0', '>='),
                'current' => PHP_VERSION
            ],
            'bcmath' => [
                'name' => 'BCMath PHP Extension',
                'status' => extension_loaded('bcmath'),
            ],
            'ctype' => [
                'name' => 'Ctype PHP Extension',
                'status' => extension_loaded('ctype'),
            ],
            'fileinfo' => [
                'name' => 'Fileinfo PHP Extension',
                'status' => extension_loaded('fileinfo'),
            ],
            'json' => [
                'name' => 'JSON PHP Extension',
                'status' => extension_loaded('json'),
            ],
            'mbstring' => [
                'name' => 'Mbstring PHP Extension',
                'status' => extension_loaded('mbstring'),
            ],
            'openssl' => [
                'name' => 'OpenSSL PHP Extension',
                'status' => extension_loaded('openssl'),
            ],
            'pdo' => [
                'name' => 'PDO PHP Extension',
                'status' => extension_loaded('pdo'),
            ],
            'tokenizer' => [
                'name' => 'Tokenizer PHP Extension',
                'status' => extension_loaded('tokenizer'),
            ],
            'xml' => [
                'name' => 'XML PHP Extension',
                'status' => extension_loaded('xml'),
            ],
        ];

        $permissions = [
            'storage/framework' => is_writable(storage_path('framework')),
            'storage/logs' => is_writable(storage_path('logs')),
            'bootstrap/cache' => is_writable(base_path('bootstrap/cache')),
        ];

        $allRequirementsMet = !in_array(false, array_column($requirements, 'status'));
        $allPermissionsSet = !in_array(false, $permissions);

        return view('install.requirements', compact('requirements', 'permissions', 'allRequirementsMet', 'allPermissionsSet'));
    }

    /**
     * Show the database configuration page
     */
    public function database()
    {
        return view('install.database');
    }

    /**
     * Test and save database configuration
     */
    public function databaseStore(Request $request)
    {
        $request->validate([
            'db_host' => 'required',
            'db_port' => 'required|numeric',
            'db_name' => 'required',
            'db_username' => 'required',
        ]);

        // Test database connection
        try {
            $connection = @mysqli_connect(
                $request->db_host,
                $request->db_username,
                $request->db_password,
                $request->db_name,
                $request->db_port
            );

            if (!$connection) {
                return back()->withErrors([
                    'connection' => 'Could not connect to the database. Please check your credentials.'
                ])->withInput();
            }

            mysqli_close($connection);

            // Update .env file
            $this->updateEnv([
                'DB_CONNECTION' => 'mysql',
                'DB_HOST' => $request->db_host,
                'DB_PORT' => $request->db_port,
                'DB_DATABASE' => $request->db_name,
                'DB_USERNAME' => $request->db_username,
                'DB_PASSWORD' => $request->db_password,
            ]);

            return redirect()->route('install.admin');
        } catch (\Exception $e) {
            return back()->withErrors([
                'connection' => 'Database connection failed: ' . $e->getMessage()
            ])->withInput();
        }
    }

    /**
     * Show admin account creation page
     */
    public function admin()
    {
        return view('install.admin');
    }

    /**
     * Run migrations and create admin account
     */
    public function install(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'app_url' => 'required|url',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        try {
            // Update app configuration in .env
            $this->updateEnv([
                'APP_NAME' => $request->app_name,
                'APP_URL' => $request->app_url,
                'APP_ENV' => 'production',
                'APP_DEBUG' => 'false',
            ]);

            // Generate APP_KEY if not set
            if (empty(env('APP_KEY'))) {
                Artisan::call('key:generate', ['--force' => true]);
            }

            // Clear configuration cache
            Artisan::call('config:clear');
            Artisan::call('cache:clear');

            // Run migrations
            Artisan::call('migrate', ['--force' => true]);

            // Create admin user
            $user = \App\Models\User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'is_admin' => true,
            ]);

            // Create installation lock file
            File::put(storage_path('installed'), now());

            // Optimize application
            Artisan::call('config:cache');
            Artisan::call('route:cache');
            Artisan::call('view:cache');

            return redirect()->route('install.complete');
        } catch (\Exception $e) {
            return back()->withErrors([
                'installation' => 'Installation failed: ' . $e->getMessage()
            ])->withInput();
        }
    }

    /**
     * Show installation complete page
     */
    public function complete()
    {
        return view('install.complete');
    }

    /**
     * Update .env file with new values
     */
    private function updateEnv(array $data)
    {
        $envFile = base_path('.env');
        
        if (!File::exists($envFile)) {
            File::copy(base_path('.env.example'), $envFile);
        }

        $envContent = File::get($envFile);

        foreach ($data as $key => $value) {
            // Add quotes around the value if it contains spaces
            $value = str_replace('"', '', $value);
            if (strpos($value, ' ') !== false || empty($value)) {
                $value = '"' . $value . '"';
            }

            // Check if key exists
            if (preg_match("/^{$key}=/m", $envContent)) {
                // Update existing key
                $envContent = preg_replace(
                    "/^{$key}=.*/m",
                    "{$key}={$value}",
                    $envContent
                );
            } else {
                // Add new key
                $envContent .= "\n{$key}={$value}";
            }
        }

        File::put($envFile, $envContent);
    }
}
