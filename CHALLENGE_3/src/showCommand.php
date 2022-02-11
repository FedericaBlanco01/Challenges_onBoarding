<?php

namespace Acme;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Acme\RenderCommands;
use Symfony\Component\Console\Helper\Table;

use GuzzleHttp\Client;

class ShowCommand extends Command
{

    public function configure()
    {
        $this->setName('show')
            ->setDescription('Returns information about the movie')
            ->addArgument('title', InputArgument::REQUIRED, 'the name of the movie')
            ->addOption('fullPlot', null, InputOption::VALUE_NONE, 'presents the plot of the movie');
    }

    public function execute(InputInterface $input, OutputInterface $output) :int
    {
        $optionValue = $input->getOption('fullPlot');
        $nameMovie= $input->getArgument('title');
        $arr_body= $this->request($nameMovie, $optionValue);
        $this-> renderTable($output, $arr_body);
        return 0;
    }

    public function renderTable($output, $arr_body){
        $table = new Table($output);
        $table->setHeaders([$arr_body['Title']. " - ".$arr_body['Year']]);
        $rows= [];

        foreach($arr_body as $key => $value) {
            if (is_scalar($value) || is_null($value)) {
                $rows[] = [$key, $value];
            }
        }
        $table->setRows($rows);
        $table->render();
    }

    public function request($name, $option)
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://www.omdbapi.com/'
        ]);

        $response = $client->request('GET', '/', [
            'query' => [
                't' => $name,
                'plot' => $option ? 'full':'short',
                'apikey' => 'f3c6067d'
            ]
        ]);

        $body = $response->getBody();
        return json_decode($body, true);
        
    }
}
