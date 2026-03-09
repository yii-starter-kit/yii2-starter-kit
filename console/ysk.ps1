# ysk.ps1 — Yii2 Starter Kit Docker helper for Windows (PowerShell)
# Equivalent to console/ysk (bash). Requires Docker Desktop with Compose v2.
#
# Usage:  .\console\ysk.ps1 <command> [arguments]
#   or, from inside the console\ folder:  .\ysk.ps1 <command>
#
# Run without arguments for full help.

#Requires -Version 5.1
$ErrorActionPreference = 'Stop'

# ---------------------------------------------------------------------------
# Project root = parent of this script's directory
# ---------------------------------------------------------------------------
$YskRoot   = Split-Path -Parent $PSScriptRoot
$ComposeFile = Join-Path $YskRoot 'docker-compose.yml'

# ---------------------------------------------------------------------------
# Colour helpers
# ---------------------------------------------------------------------------
function Write-Info    { param([string]$Msg) Write-Host $Msg -ForegroundColor Cyan }
function Write-Success { param([string]$Msg) Write-Host $Msg -ForegroundColor Green }
function Write-Warn    { param([string]$Msg) Write-Host $Msg -ForegroundColor Yellow }
function Write-Err     { param([string]$Msg) Write-Host $Msg -ForegroundColor Red }

# ---------------------------------------------------------------------------
# Ensure docker compose v2 is available
# ---------------------------------------------------------------------------
if (-not (docker compose version 2>$null)) {
    Write-Err "Docker Compose v2 not found. Install Docker Desktop and make sure it is running."
    exit 1
}

$Dc = "docker", "compose", "-f", $ComposeFile

$ConsoleService = 'console'
$NodeService    = 'node'
$DbService      = 'db'

# ---------------------------------------------------------------------------
# Helpers
# ---------------------------------------------------------------------------
function Invoke-Dc {
    & docker compose -f $ComposeFile @args
    if ($LASTEXITCODE -ne 0) { exit $LASTEXITCODE }
}

function Require-Running {
    $running = & docker compose -f $ComposeFile ps --filter "status=running" --services 2>$null
    if ($running -notmatch "(?m)^${ConsoleService}$") {
        Write-Err "Containers are not running. Start them first with:  .\console\ysk.ps1 up"
        exit 1
    }
}

function Get-EnvValue {
    param([string]$Key, [string]$Default)
    $envFile = Join-Path $YskRoot '.env'
    if (Test-Path $envFile) {
        $line = Select-String -Path $envFile -Pattern "^\s*${Key}\s*=" | Select-Object -First 1
        if ($line) {
            return ($line.Line -split '=', 2)[1].Trim().Trim('"').Trim("'")
        }
    }
    return $Default
}

# ---------------------------------------------------------------------------
# Help
# ---------------------------------------------------------------------------
function Show-Help {
    Write-Host ""
    Write-Host "ysk — Yii2 Starter Kit Docker helper" -ForegroundColor Cyan -NoNewline
    Write-Host "  (PowerShell edition)"
    Write-Host ""
    Write-Host "Lifecycle:" -ForegroundColor Yellow
    Write-Host "  up                       Start all services (detached)"
    Write-Host "  up --build               Rebuild images then start"
    Write-Host "  down                     Stop and remove containers"
    Write-Host "  restart                  Restart all containers"
    Write-Host "  build                    Build all images without starting"
    Write-Host "  ps                       Show container statuses"
    Write-Host "  logs [service]           Tail logs (all services or one)"
    Write-Host ""
    Write-Host "PHP / Application:" -ForegroundColor Yellow
    Write-Host "  install                  Install Composer + npm deps inside containers"
    Write-Host "  php <args>               Run php in the console container"
    Write-Host "  yii <cmd>                Run a Yii2 console command"
    Write-Host "  composer <args>          Run Composer in the console container"
    Write-Host "  migrate [--fresh]        Run DB migrations (--fresh recreates DB)"
    Write-Host "  setup                    Run app/setup (migrations + keys + permissions)"
    Write-Host ""
    Write-Host "Frontend / Assets:" -ForegroundColor Yellow
    Write-Host "  npm <args>               Run npm in the node container"
    Write-Host "  build-assets             Build frontend assets for production"
    Write-Host "  watch-assets             Watch and rebuild frontend assets"
    Write-Host ""
    Write-Host "Database:" -ForegroundColor Yellow
    Write-Host "  mysql                    Open an interactive MySQL shell"
    Write-Host "  mysql-dump [file]        Dump the database to a .sql file"
    Write-Host "  mysql-import <file>      Import a .sql file into the database"
    Write-Host ""
    Write-Host "Testing:" -ForegroundColor Yellow
    Write-Host "  test [suite] [args]      Run Codeception tests"
    Write-Host "  test-build               Rebuild Codeception suite definitions"
    Write-Host ""
    Write-Host "Shell access:" -ForegroundColor Yellow
    Write-Host "  shell [service]          Open bash in a container (default: console)"
    Write-Host "  root  [service]          Open bash as root in a container"
    Write-Host ""
    Write-Host "Maintenance:" -ForegroundColor Yellow
    Write-Host "  xdebug on|off            Toggle Xdebug in the PHP containers"
    Write-Host "  clean                    Remove containers, volumes, and orphans"
    Write-Host ""
    Write-Host "Examples:" -ForegroundColor Cyan
    Write-Host "  .\console\ysk.ps1 up"
    Write-Host "  .\console\ysk.ps1 install"
    Write-Host "  .\console\ysk.ps1 setup"
    Write-Host "  .\console\ysk.ps1 yii migrate/up"
    Write-Host "  .\console\ysk.ps1 composer require yiisoft/yii2-redis"
    Write-Host "  .\console\ysk.ps1 shell backend"
    Write-Host "  .\console\ysk.ps1 test backend unit"
    Write-Host "  .\console\ysk.ps1 mysql-dump backup.sql"
    Write-Host "  .\console\ysk.ps1 xdebug on"
    Write-Host ""
}

# ---------------------------------------------------------------------------
# Command dispatch
# ---------------------------------------------------------------------------
$Command  = if ($args.Count -gt 0) { $args[0] } else { '' }
$RestArgs = if ($args.Count -gt 1) { $args[1..($args.Count - 1)] } else { @() }

switch ($Command) {

    # -- Lifecycle -----------------------------------------------------------

    'up' {
        Write-Info "Starting services..."
        Invoke-Dc up -d @RestArgs
        Write-Success "Services started."
        Write-Host ""
        Write-Host "  Frontend:  " -NoNewline; Write-Host "http://yii2-starter-kit.localhost"        -ForegroundColor Blue
        Write-Host "  Backend:   " -NoNewline; Write-Host "http://backend.yii2-starter-kit.localhost" -ForegroundColor Blue
        Write-Host "  API:       " -NoNewline; Write-Host "http://api.yii2-starter-kit.localhost"    -ForegroundColor Blue
        Write-Host "  Storage:   " -NoNewline; Write-Host "http://storage.yii2-starter-kit.localhost" -ForegroundColor Blue
        Write-Host "  Mail:      " -NoNewline; Write-Host "http://localhost:1080"                    -ForegroundColor Blue
    }

    'down' {
        Write-Info "Stopping services..."
        Invoke-Dc down @RestArgs
        Write-Success "Services stopped."
    }

    'restart' {
        Write-Info "Restarting services..."
        Invoke-Dc restart @RestArgs
        Write-Success "Services restarted."
    }

    'build' {
        Write-Info "Building images..."
        Invoke-Dc build @RestArgs
        Write-Success "Images built."
    }

    'ps' { Invoke-Dc ps }

    'logs' { Invoke-Dc logs -f @RestArgs }

    # -- PHP / Application ---------------------------------------------------

    'php' {
        Require-Running
        Invoke-Dc exec $ConsoleService php @RestArgs
    }

    'yii' {
        Require-Running
        Invoke-Dc exec $ConsoleService php console/yii @RestArgs
    }

    'composer' {
        Require-Running
        Invoke-Dc exec $ConsoleService composer @RestArgs
    }

    'migrate' {
        Require-Running
        if ($RestArgs -contains '--fresh') {
            Write-Warn "Dropping and recreating all tables..."
            Invoke-Dc exec $ConsoleService php console/yii migrate/fresh --interactive=0
        } else {
            Invoke-Dc exec $ConsoleService php console/yii migrate/up --interactive=0
        }
    }

    'install' {
        Require-Running
        Write-Info "Installing PHP dependencies (Composer)..."
        Invoke-Dc exec $ConsoleService composer install --prefer-dist -o
        Write-Success "PHP dependencies installed."
        Write-Info "Installing Node.js dependencies (npm)..."
        Invoke-Dc run --rm $NodeService npm install
        Write-Success "Node.js dependencies installed."
    }

    'setup' {
        Require-Running
        Write-Info "Running application setup..."
        Invoke-Dc exec $ConsoleService php console/yii app/setup --interactive=0
        Write-Success "Setup complete."
    }

    # -- Frontend / Assets ---------------------------------------------------

    'npm'          { Invoke-Dc run --rm $NodeService npm @RestArgs }

    'build-assets' {
        Write-Info "Building frontend assets..."
        Invoke-Dc run --rm $NodeService npm run build
        Write-Success "Assets built."
    }

    'watch-assets' {
        Write-Info "Watching frontend assets (Ctrl-C to stop)..."
        Invoke-Dc run --rm $NodeService npm run watch
    }

    # -- Database ------------------------------------------------------------

    'mysql' {
        Require-Running
        $user = Get-EnvValue 'DB_USERNAME' 'ysk_dbu'
        $pass = Get-EnvValue 'DB_PASSWORD' 'ysk_pass'
        $db   = Get-EnvValue 'DB_NAME'     'yii2-starter-kit'
        Invoke-Dc exec $DbService mysql "-u$user" "-p$pass" $db
    }

    'mysql-dump' {
        Require-Running
        $timestamp = Get-Date -Format 'yyyyMMdd_HHmmss'
        $output    = if ($RestArgs.Count -gt 0) { $RestArgs[0] } else { "dump_${timestamp}.sql" }
        $outPath   = Join-Path $YskRoot $output
        $user = Get-EnvValue 'DB_USERNAME' 'ysk_dbu'
        $pass = Get-EnvValue 'DB_PASSWORD' 'ysk_pass'
        $db   = Get-EnvValue 'DB_NAME'     'yii2-starter-kit'
        Write-Info "Dumping database to $output..."
        & docker compose -f $ComposeFile exec -T $DbService mysqldump "-u$user" "-p$pass" $db | Set-Content -Path $outPath -Encoding UTF8
        if ($LASTEXITCODE -ne 0) { Write-Err "Dump failed."; exit $LASTEXITCODE }
        Write-Success "Dump saved to $output"
    }

    'mysql-import' {
        Require-Running
        if ($RestArgs.Count -eq 0) { Write-Err "Usage: ysk.ps1 mysql-import <file.sql>"; exit 1 }
        $importFile = $RestArgs[0]
        if (-not (Test-Path $importFile)) { Write-Err "File not found: $importFile"; exit 1 }
        $user = Get-EnvValue 'DB_USERNAME' 'ysk_dbu'
        $pass = Get-EnvValue 'DB_PASSWORD' 'ysk_pass'
        $db   = Get-EnvValue 'DB_NAME'     'yii2-starter-kit'
        Write-Info "Importing $importFile..."
        Get-Content $importFile | & docker compose -f $ComposeFile exec -T $DbService mysql "-u$user" "-p$pass" $db
        if ($LASTEXITCODE -ne 0) { Write-Err "Import failed."; exit $LASTEXITCODE }
        Write-Success "Import complete."
    }

    # -- Testing -------------------------------------------------------------

    'test'       {
        Require-Running
        Invoke-Dc exec $ConsoleService vendor/bin/codecept run @RestArgs
    }

    'test-build' {
        Require-Running
        Write-Info "Building Codeception suite definitions..."
        Invoke-Dc exec $ConsoleService vendor/bin/codecept build
    }

    # -- Shell access --------------------------------------------------------

    'shell' {
        Require-Running
        $svc = if ($RestArgs.Count -gt 0) { $RestArgs[0] } else { $ConsoleService }
        Invoke-Dc exec $svc bash
    }

    'root' {
        Require-Running
        $svc = if ($RestArgs.Count -gt 0) { $RestArgs[0] } else { $ConsoleService }
        Invoke-Dc exec --user root $svc bash
    }

    # -- Maintenance ---------------------------------------------------------

    'xdebug' {
        $mode = if ($RestArgs.Count -gt 0) { $RestArgs[0] } else { '' }
        switch ($mode) {
            'on' {
                Write-Info "Enabling Xdebug (XDEBUG_MODE=debug)..."
                $env:XDEBUG_MODE = 'debug'
                Invoke-Dc up -d --no-deps frontend backend api console storage
                Write-Success "Xdebug enabled. Restart your IDE listener."
            }
            'off' {
                Write-Info "Disabling Xdebug (XDEBUG_MODE=off)..."
                $env:XDEBUG_MODE = 'off'
                Invoke-Dc up -d --no-deps frontend backend api console storage
                Write-Success "Xdebug disabled."
            }
            default {
                Write-Err "Usage: ysk.ps1 xdebug on|off"
                exit 1
            }
        }
    }

    'clean' {
        Write-Warn "This will remove ALL containers, volumes and orphans for this project."
        $confirm = Read-Host "Are you sure? [y/N]"
        if ($confirm -eq 'y' -or $confirm -eq 'Y') {
            Invoke-Dc down -v --remove-orphans
            Write-Success "Cleaned up."
        } else {
            Write-Info "Aborted."
        }
    }

    # -- Help / fallback -----------------------------------------------------

    { $_ -in '', 'help', '--help', '-h' } {
        Show-Help
    }

    default {
        Write-Err "Unknown command: $Command"
        Show-Help
        exit 1
    }
}
