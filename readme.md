## Setup

1. Create a `public_html` directory in the root of this project (it will be ignored by git):
    ```bash
    mkdir public_html
    ```
1. Check out dotorg's `wp-content` directory within `public_html`:
    ```bash
    svn co https://dotorg.svn.wordpress.org/wordpress/website/wp-content public_html/wp-content
   ```
1. Start up the container:
    ```bash
    docker-compose up
    ```

    Watch for the following output, to ensure that the server and database are finished starting up.
    ```
    phpunit_wp_1  | […] NOTICE: ready to handle connections
    …
    phpunit_db_1  | […] [Note] mysqld: ready for connections.
    ```
1. The first time you run this, you'll need to install the tests (future runs can skip this step). First, open a shell inside the web container:
    ```bash
    docker-compose exec phpunit_wp bash
    ```

    Then run the install script. It will download WordPress & the unit test framework (this skips installing a database, since that is set up as part of the docker process).
    ```bash
    /var/scripts/install-wp-tests.sh wordpress_test root '' phpunit_db latest true
    ```

    Sometimes the download will time out. If that happens, you can delete `/tmp/wp` from the container, and re-run the install script. The test files will be added to the `.docker/test_suite` folder, which is ignored by git.
1. Now you can run `phpunit`. From the project folder on your machine:
    ```bash
    docker-compose exec phpunit_wp phpunit
    ```

    If you're still in the shell from the previous step, you can run `phpunit` directly.
    ```bash
    phpunit
    ```

    Either way, you'll see "Installing...", and then the tests will run.
