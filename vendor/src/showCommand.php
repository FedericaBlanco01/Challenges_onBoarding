<?php namespace Acme;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class showCommand extends Command{

    public function configure(){
        $this -> setName('show')
        ->setDescription('Returns information about the movie')
        -> addArgument('title', InputArgument::REQUIRED, 'the name of the movie')
        ->addOption('fullPlot', null, InputOption::VALUE_NONE, 'presents the plot of the movie' );
    }

    public function excute(){

    }
}