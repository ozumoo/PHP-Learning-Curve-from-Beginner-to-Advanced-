<?php
namespace Acme;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface ;
use Symfony\Component\Console\Input\InputArgument; //optional || required
use Symfony\Component\Console\Input\InputOption;
use GuzzleHttp\ClientInterFace;
use ZipArchive;
class NewCommand extends Command
{

	private $client ; 

	function __construct(ClientInterFace $client)
	{
		$this->client = $client;

		parent::__construct();
	}

	public function configure()
	{
		$this->setName('new')
			->setDescription('Create a new Laravel Setup')
			->addArgument('name',InputArgument::REQUIRED);
	}
	public function execute(InputInterface $input,OutputInterface $output)
	{
		//get Directory 
		$directory = getcwd() . '/'. $input->getArgument('name');

		$output->writeln('<info>Crafting Application/info>');


		//assert the folder already exists
		$this->assertApplicationDoesNotExist($directory,$output);

		//Download nightly version of laravel 
		$this->download($zipFile = $this->makeFileName())
			->extract($zipFile,$directory)
			->cleanUp($zipFile);

		$output->writeln('<comment>Application Ready</comment>');
	}
	private function assertApplicationDoesNotExist($directory,OutputInterface $output)
	{	
		//check if it's a directory 
		if (is_dir($directory)) {
			$output->writeln('<error>application already exists</error>');
			exit(1);
		}
	}
	private function makeFileName()
	{
		return getcwd() . '/laravel_' . md5(time().uniqid()) . '.zip'  ;
	}
	private function download($zipFile)
	{
		$response = $this->client->get('http://cabinet.laravel.com/latest.zip')->getBody();

		file_put_contents($zipFile,$response);

		return $this;
	}
	private function extract($zipFile ,$directory )
	{
		$archive = new ZipArchive;

		$archive->open($zipFile);
		$archive->extractTo($directory);
		$archive->close();

		return $this;
	}
	private  function cleanUp($zipFile)
	{
		@chmod($zipFile,0777);
		@unlink($zipFile);
		return $this;
	}

}
