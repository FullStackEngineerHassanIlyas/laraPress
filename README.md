![LaraPress](logo.png?raw=true "LaraPress")
# LaraPress

## Installation

Clone the repo first by `git clone https://github.com/fullstackdeveloper47/laraPress.git`

then upload this zip file or just extract it to your WP plugins folder `path/to/wp-content/plugins`

Navigate to your main plugin folder 

	> path/to/wp-content/plugins/laraPress

Then `npm run setup-me`

### Commands
You can easily create `Controllers`, `Models` and `Traits` using `php wp-artisan` command.
To create controller you would do `php wp-artisan make:controller`

You can also specify some parameters in make command.

`> php wp-artisan make:controller SampleController --use=SampleHandler`

The above command will use a `Trait` in your `SampleController`class

	...
    class SampleController extends Controller {
    
    	use SampleHandler;
    	...
    }

#### Version 0.17.1