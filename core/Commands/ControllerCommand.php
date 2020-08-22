<?php

namespace _NAMESPACE_\Core\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Controller command
 */
class ControllerCommand extends Command {

	protected $root = PLUGIN_NAME_PATH;

	protected function configure() {
		$this
			->setName('make:controller')
			->setDescription('Creates a controller')
			->addArgument(
				'name',
				InputArgument::OPTIONAL,
				'For Controller?'
			)
			->addOption(
				'use',
				null,
				InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
				'Which handler(s) would you like to use?'
			)
			->addOption(
				'createTrait',
				null,
				InputOption::VALUE_NONE,
				'Whether to create trait (handler) or not!'
			)
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		$controllersDir = $this->root . '/app/Controllers';
		if (!file_exists( $controllersDir )) {
			mkdir( $controllersDir, 0755, true);
		}

		$sampleText = '';

		$controllerName = $input->getArgument( 'name' );

		$handler 		= $input->getOption( 'use' );
		$isCreate 		= $input->getOption( 'createTrait' );

		$usingHandler = '';
		$nameSpaceHandler = '';

		if ($controllerName) {

			if ( is_array( $handler ) && !empty( $handler ) ) {
				$usingHandler 	  = implode( ",\n\t\t", $handler );
				$nameSpaceHandler = implode( ', ', $handler );

				if ( count($handler) > 1 ) {
					$nameSpaceHandler = '{ ' .$nameSpaceHandler. ' }';
				}

				if ( $isCreate ) {
					// We will create trait file
					$sampleTraitText = file_get_contents( $this->root . '/core/samples/SampleTrait.php' );


					foreach ($handler as $key => $_handler) {
						$sampleTraitTextReplaced = str_replace( 'SampleTrait', $_handler, $sampleTraitText );

						file_put_contents( $this->root . '/app/traits/' . $_handler . '.php', $sampleTraitTextReplaced );
					}
				}
			}

			$text = '<info>Controller "'. $controllerName . '" Created!</info>';
			$sampleText = file_get_contents( $this->root . '/core/samples/SampleController.php' );

			$sampleText = str_replace( [
				'SampleController', !empty( $handler ) ? 'SampleHandler' : 'use SampleHandler;', ! empty( $handler ) ? 'HandlerNamespace' : 'use _NAMESPACE_\App\Traits\HandlerNamespace;'
				], 
				[
					$controllerName, 
					$usingHandler, 
					$nameSpaceHandler 
				], 
				$sampleText 
			);

			file_put_contents( $this->root . '/app/Controllers/' . $controllerName . '.php', $sampleText );

		} else {
			$text = '<error>Please specify controller name</error>';
		}

		$output->writeln( $text );

		return 0;
	}
}