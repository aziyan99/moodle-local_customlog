# Custom Log

Moodle plugin to help plugin development process to store custom log to database.

## Install

### Installing from zipped Repository file

1. Download this Repo as a zipped file
2. Install from Moodle **Site administration**, plugins menu
3. Refresh Moodle web page, and follow the instructions to install and upgrades the DB

### Installing by clonning Repository

1. Copy clonned plugin directory to Moodle local path: **<moodle_base_dir>/local**
2. Refresh Moodle web page, and follow the instructions to install and upgrades the DB

## Usage

Call the static function from code to store log

```php
\local_customlog\helpers\log::store_log(['<the-log>']);
```

The `store_log()` function accept one parameter and it is must be type of array, or array of object with purpose to
running on `json_encode()` function.

To view the log report page go to Site administration > Plugins > Local plugins > Custom Log.
