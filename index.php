<?php
require_once './vendor/autoload.php';

use Carbon\Carbon;
use App\Animal;
use App\Food;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

function progressBar(): void
{
    $output = new ConsoleOutput();
    $total = 100;
    $progressBar = new ProgressBar($output, $total);
    $progressBar->start();

    for ($i = 0; $i < $total; $i++) {
        usleep(50000);//5 seconds
        $progressBar->advance();
    }
    $progressBar->finish();
}

class Zookeeper
{
    private array $animals;
    private array $foods;

    public function __construct(array $animals, array $foods)
    {
        $this->animals = $animals;
        $this->foods = $foods;
    }

    public function start(): void
    {
        echo "Zookeeper started!\n";
        $keepWorking = true;

        while ($keepWorking == true) {

            foreach ($this->animals as $index => $animal) {
                echo "$index. {$animal->getName()}\n";

            }
            $quit = (array_key_last($this->animals) + 1) . ". Quit\n";
            echo $quit;

            $animalIndex = (int)readline("Please select options : \n");
            if ($animalIndex == $quit) {
                exit;
            }

            $selectedAnimal = $this->animals[$animalIndex];

            $workWithAnimal = true;
            while ($workWithAnimal) {
                echo $selectedAnimal->getDiscription() . PHP_EOL;

                if ($selectedAnimal->getLastTime() !== null) {
                    echo "Last interaction with animal: " . $selectedAnimal->getLastTime() . PHP_EOL;
                }

                echo "1. Pet \n2. Play\n3. Feed \n4. Work\n5. Return to selection\n";

                $choice = (int)readline("Select a choice: ");
                switch ($choice) {
                    case 1:
                        $selectedAnimal->pet();
                        progressBar();
                        $now = carbon::now();
                        $selectedAnimal->setLastTime($now);
                        break;

                    case 2:
                        $now = carbon::now();
                        progressBar();
                        $selectedAnimal->setLastTime($now);
                        $selectedAnimal->play();
                        break;
                    case 3:
                        foreach ($this->foods as $index => $food) {
                            echo "$index {$food->getFood()}\n";
                        }
                        $foodIndex = (int)readline("Enter number to select food: ");
                        $selectedFood = $this->foods[$foodIndex]->getFood();
                        $selectedAnimal->feed($selectedFood);
                        $now = carbon::now();
                        $selectedAnimal->setLastTime($now);
                        progressBar();

                        break;
                    case 4:
                        progressBar();
                        $selectedAnimal->work();
                        $now = carbon::now();
                        $selectedAnimal->setLastTime($now);
                        break;
                    case 5:
                        $workWithAnimal = false;
                        break;
                }
            }
        }
    }
}

$animals =
    [
        new Animal('donkey', 100, 'carrots', 100),
        new Animal('cow', 100, 'hay', 100),
        new Animal('chicken', 100, 'grain', 100)
    ];

$foods =
    [
        new Food('carrots'),
        new Food('hay'),
        new Food('grain'),
        new Food('potatoes'),
        new Food('meat'),
        new Food('seeds'),
    ];

$zookeeper = new Zookeeper($animals, $foods);
$zookeeper->start();