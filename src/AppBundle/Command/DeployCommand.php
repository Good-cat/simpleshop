<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\SimpleXMLElement;

class DeployCommand extends ContainerAwareCommand
{
protected function configure()
{
$this
->setName('deploy')
->setDescription('deploy project on hosting by cron');
}

protected function execute(InputInterface $input, OutputInterface $output)
{
    $out = shell_exec('php app/console ps:start');
}
}