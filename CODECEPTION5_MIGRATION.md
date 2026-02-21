# Codeception 5 Migration Guide

This document describes the changes made to migrate the test suite from Codeception 4 to Codeception 5.

## Summary of Changes

### 1. Removed Deprecated Configuration

**What changed:** Removed `suite_class: \PHPUnit_Framework_TestSuite` from all codeception.yml files.

**Why:** This setting is deprecated in Codeception 5 and no longer needed. Codeception 5 uses PHPUnit 9+ directly.

**Files affected:**
- `backend/tests/codeception.yml`
- `frontend/tests/codeception.yml`
- `api/tests/codeception.yml`
- `common/tests/codeception.yml`
- `console/tests/codeception.yml`

### 2. Converted Cept Tests to Cest Format

**What changed:** All procedural Cept test files were converted to class-based Cest format.

**Why:** Codeception 5 recommends using Cest classes for better organization, reusability, and IDE support.

**Converted files:**
- `backend/tests/functional/LoginCept.php` → `LoginCest.php`
- `backend/tests/acceptance/LoginCept.php` → `LoginCest.php`
- `frontend/tests/functional/HomeCept.php` → `HomeCest.php`
- `frontend/tests/functional/LoginCept.php` → `LoginCest.php`
- `frontend/tests/acceptance/HomeCept.php` → `HomeCest.php`
- `frontend/tests/acceptance/LoginCept.php` → `LoginCest.php`

**Example conversion:**

Before (Cept):
```php
<?php
use tests\frontend\FunctionalTester;

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that home page works');
$I->amOnPage(Yii::$app->homeUrl);
```

After (Cest):
```php
<?php
namespace tests\frontend\functional;

use tests\frontend\FunctionalTester;

class HomeCest
{
    public function ensureHomePageWorks(FunctionalTester $I)
    {
        $I->wantTo('ensure that home page works');
        $I->amOnPage(\Yii::$app->homeUrl);
    }
}
```

### 3. Updated Method Signatures

**What changed:** 
- Removed `$event` parameter from `_before()`, `_after()`, and `_fail()` lifecycle methods
- Removed `$scenario` parameter from test methods
- Removed empty lifecycle methods

**Why:** Codeception 5 uses a simpler method signature for lifecycle hooks. The `$event` parameter is no longer passed.

**Before:**
```php
public function _before($event) { }
public function _after($event) { }
public function testSomething($I, $scenario) { }
```

**After:**
```php
public function _after() { }
public function testSomething($I) { }
```

### 4. Reorganized Test Structure

**What changed:** Tests moved from centralized `tests/` directory into each application directory.

**Why:** This follows Codeception 5 best practices and makes tests more closely associated with their respective applications.

**New structure:**
```
backend/tests/          (was tests/backend/)
frontend/tests/         (was tests/frontend/)
api/tests/              (was tests/api/)
console/tests/          (was tests/console/)
tests/common/           (unchanged - shared tests)
tests/config/           (unchanged - shared test configs)
```

### 5. Updated Configuration

**What changed:**
- Updated `configFile` paths in suite configurations to reflect new locations
- Updated root `codeception.yml` to include new test paths
- Updated `composer.json` autoload-dev to include new test directories
- Fixed API bootstrap to load correct application config

### 6. Code Quality Improvements

**What changed:**
- Added proper namespaces to all Cest classes (e.g., `tests\frontend\functional`)
- Added missing `use` statements for tester classes
- Fixed helper class namespaces

## Breaking Changes

None - all existing test functionality has been preserved.

## Running Tests

### Run all tests:
```bash
vendor/bin/codecept run
```

### Run tests for a specific application:
```bash
# Backend tests
vendor/bin/codecept run -c backend/tests

# Frontend tests
vendor/bin/codecept run -c frontend/tests

# API tests
vendor/bin/codecept run -c api/tests

# Console tests
vendor/bin/codecept run -c console/tests

# Common tests
vendor/bin/codecept run -c tests/common
```

### Build test actors after changes:
```bash
vendor/bin/codecept build
```

## Yii2 Module Features

The tests are configured to use the Yii2 Codeception Module with the following features:

### ORM Features
Used in unit and functional tests to work with database records:
- `seeRecord($model, $attributes)` - Check if record exists
- `dontSeeRecord($model, $attributes)` - Check if record doesn't exist
- `haveRecord($model, $attributes)` - Create a record
- `grabRecord($model, $attributes)` - Retrieve a record

### Fixtures
Tests use the `FixtureHelper` to load test data before running tests.

### Email
Unit tests can verify emails sent by the application using the `email` part of the Yii2 module.

## References

- [Codeception 5 Documentation](https://codeception.com/docs/05-UnitTests)
- [Yii2 Module Documentation](https://codeception.com/docs/modules/Yii2)
- [Migration to Codeception 5](https://codeception.com/docs/UpdateTo5)
