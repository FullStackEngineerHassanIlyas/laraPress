# WP Plugin Framework

## Installation
Navigate to your main plugin folder 

	> path/to/wp-content/plugins/wp-plugin-framwork

Then `npm run setup-me`

## Usage

### Commands

Available commands:

 - `make:controller`
 - `make:model`

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

#### Version 0.16.1