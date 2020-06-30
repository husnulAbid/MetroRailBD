<?php
/**
 * Created by PhpStorm.
 * User: Abid
 * Date: 06/05/2018
 * Time: 06:09 PM
 */

class Graph1
{
    public $graph;
    public $visited = array();

    public function __construct($graph) {
        $this->graph = $graph;
    }

    // find least number of hops (edges) between 2 nodes
    // (vertices)
    public function breadthFirstSearch($origin, $destination) {
        // mark all nodes as unvisited
        foreach ($this->graph as $vertex => $adj) {
            $this->visited[$vertex] = false;
        }

        // create an empty queue
        $q = new SplQueue();

        // enqueue the origin vertex and mark as visited
        $q->enqueue($origin);
        $this->visited[$origin] = true;

        // this is used to track the path back from each node
        $path = array();
        $path[$origin] = new SplDoublyLinkedList();
        $path[$origin]->setIteratorMode(
            SplDoublyLinkedList::IT_MODE_FIFO|SplDoublyLinkedList::IT_MODE_KEEP
        );

        $path[$origin]->push($origin);

        $found = false;
        // while queue is not empty and destination not found
        while (!$q->isEmpty() && $q->bottom() != $destination) {
            $t = $q->dequeue();

            if (!empty($this->graph[$t])) {
                // for each adjacent neighbor
                foreach ($this->graph[$t] as $vertex) {
                    if (!$this->visited[$vertex]) {
                        // if not yet visited, enqueue vertex and mark
                        // as visited
                        $q->enqueue($vertex);
                        $this->visited[$vertex] = true;
                        // add vertex to current path
                        $path[$vertex] = clone $path[$t];
                        $path[$vertex]->push($vertex);
                    }
                }
            }
        }

        if (isset($path[$destination])) {

            foreach ($path[$destination] as $vertex) {
                echo $vertex. " ";

            }
            echo "\n";
        }
        else {
            echo "No route from $origin to $destination";
        }
    }
}

