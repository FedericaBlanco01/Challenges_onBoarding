<?php

namespace Acme;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Acme\RenderCommands;

use GuzzleHttp\Client;

class showCommand extends Command
{

    public function configure()
    {
        $this->setName('show')
            ->setDescription('Returns information about the movie')
            ->addArgument('title', InputArgument::REQUIRED, 'the name of the movie')
            ->addOption('fullPlot', null, InputOption::VALUE_NONE, 'presents the plot of the movie');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://www.omdbapi.com/'
        ]);

        $optionValue = $input->getOption('fullPlot');
        $optional = '';

        if ($optionValue === false) {
            $optional = 'short';
        } else {
            $optional = 'full';
        }

        $response = $client->request('GET', '/', [
            'query' => [
                't' => $input->getArgument('title'),
                'plot' => $optional,
                'apikey' => 'f3c6067d'
            ]
        ]);


        $body = $response->getBody();
        $arr_body = json_decode($body); //code from json to php object

        print ($arr_body);

    }
}
