<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Build project
To use this project you will need to use Docker

Then run the command

```
make setup
```

## Api Requests

You can use the following postman collection: [https://www.postman.com/jayslater2001-7848394/workspace/woven/collection/50956340-e7c9338b-9c1c-4eb8-ba7e-75eff87583bf?action=share&source=copy-link&creator=50956340](https://www.postman.com/jayslater2001-7848394/workspace/woven/collection/50956340-e7c9338b-9c1c-4eb8-ba7e-75eff87583bf?action=share&source=copy-link&creator=50956340)

## Next Steps / Improvements

- Create inhouse csv importer instead of using a package, this is so we can control the security and ensure that if that package was to get hacked in some way it wouldn't affect us
- Better error handling, using something like sentry or data dog and have more error handling or log processes like when each batch is importing
- Add more testing, I ran out of time to create the tests for the csv upload, but I would create a csv with some dummy data and test that the data is input into the db correctly, also test for errors like invalid data or form missing
- Have an option to return the all-investor-amounts data as a csv or json
- If there was a frontend, make the all-investor-amounts do the data in a queue, and notify the user when the data is ready
- Have something to generate API keys so only requests with these keys can get the data
- Have a front end to get these endpoints and display them in a more userfriendly manner
