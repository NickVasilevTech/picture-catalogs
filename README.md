# Setup Instructions
1. Create an .env file by copying the .env.example and editing it if neccessary.
2. Please use the `./vendor/bin/sail up --build` command (or your equivalent alias) to create and start the Laravel Docker containers. If needed leave the terminal working
3. Run `./vendor/bin/sail artisan key:generate`
4. Run `npm install`. Then run `npm run dev`
5. Run this command `./vendor/bin/sail artisan migrate`
## Note
Only the home page with the latest pictures has been 
