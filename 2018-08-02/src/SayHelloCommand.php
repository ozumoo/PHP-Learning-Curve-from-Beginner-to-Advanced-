<?php
namespace Acme;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface ;
use Symfony\Component\Console\Input\InputArgument; //optional || required
use Symfony\Component\Console\Input\InputOption;
class sayHelloCommand extends Command
{
	public function configure()
	{
		$this->setName('sayHelloTo')
			->setDescription('Offer a greeting to the given user')
			->addArgument('name',InputArgument::REQUIRED,'Your Name')
			// //name ==> shortcut ==> optional? ==> description -- will be called with 2 --
			->addOption('greeting',null,InputOption::VALUE_OPTIONAL,'override greeting');
	}
	public function execute(InputInterface $input,OutputInterface $output)
	{
		$message = sprintf('%s %s',$input->getOption('greeting'),$input->getArgument('name'));

		$output->writeln("<info>{$message}</info>");
	}
}
