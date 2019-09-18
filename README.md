<p align="center">
<h1>Multi login Authentication</h1>
</p>

## About MutliLogin

- It has two role User and Admin.
- User and Admin can login at the same time.
- After login as User, User can't go to the Admin's home(if not logged in as admin) and same for the Admin too.
- You can add as many role as you want.
- User and Admin login/logout from different endpoint.

## How to add more role?

- add new guard in `/config/auth.php`
- add model, DB table and migrate DB
- add controller and Auth controller(follow other files in `app/Http/Controllers`)
- add view and routes