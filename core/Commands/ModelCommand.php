<?php 

namespace _NAMESPACE_\Core\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Model Command
 */
class ModelCommand extends Command {

	protected $root = PLUGIN_NAME_PATH;

	protected function configure() {
		$this
			->setName('make:model')
			->setDescription('Creates a model')
			->addArgument(
				'name',
				InputArgument::OPTIONAL,
				'For Model?'
			)
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		$modelsDir = $this->root . '/app/Models';
		if (!file_exists( $modelsDir )) {
			mkdir( $modelsDir, 0755, true);
		}

		$sampleText = '';

		$modelName = $input->getArgument( 'name' );
		$text = '<error>Please specify controller name</error>';

		if ( $modelName ) {

			$sampleText = file_get_contents($this->root . '/core/samples/SampleModel.php');

			$sampleText = str_replace('SampleModel', $modelName, $sampleText);

			if ( file_put_contents($this->root . '/app/Models/'.$modelName.'.php', $sampleText) ) {
				$text = '<info>Model "'. $modelName . '" Created!</info>';
			}
		}

		$output->writeln( $text );
		
		return 0;
	}
}