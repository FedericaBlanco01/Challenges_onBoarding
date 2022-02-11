<?php namespace Acme;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;


class RenderCommands extends Command {

    public function configure(){
        $this->setName('render')
        ->setDescription('render some tabular data');
    }

    public function execute(InputInterface $input, OutputInterface $output){
        
        $table= new Table($output);

        foreach ($input as $line){
             $table-> setRow(0, $line)
                ->render();
        }
    }


}
