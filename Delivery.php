<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="Delivery.css" />
    <title>Infinite Learn</title>
    <script type="text/javascript">
      function DijkstrasAlgo() {
        var dest = document.getElementById("Destination").value;
        //display pictures start
        if (dest == "H1") {
          document.getElementById("DSASampleMap").src = "MapRouteH1.PNG";
        } else if (dest == "H2") {
          document.getElementById("DSASampleMap").src = "MapRouteH2.PNG";
        } else if (dest == "H3") {
          document.getElementById("DSASampleMap").src = "MapRouteH3.PNG";
        } else if (dest == "H4") {
          document.getElementById("DSASampleMap").src = "MapRouteH4.PNG";
        } else if (dest == "H5") {
          document.getElementById("DSASampleMap").src = "MapRouteH5.PNG";
        } else if (dest == "H6") {
          document.getElementById("DSASampleMap").src = "MapRouteH6.PNG";
        } else if (dest == "H7") {
          document.getElementById("DSASampleMap").src = "MapRouteH7.PNG";
        } else if (dest == "H8") {
          document.getElementById("DSASampleMap").src = "MapRouteH8.PNG";
        }
        //display pictures end
        class PriorityQueue {
          constructor() {
            this.values = [];
          }
          enqueue(val, distance) {
            this.values.push({ val, distance });
            this.sort();
          }
          dequeue() {
            return this.values.shift();
          }
          sort() {
            this.values.sort((a, b) => a.distance - b.distance);
          }
        }

        class WeightedGraph {
          constructor() {
            this.adjacencyList = {};
          }
          addVertex(vertex) {
            if (!this.adjacencyList[vertex]) this.adjacencyList[vertex] = [];
          }
          addEdge(vertex1, vertex2, weight) {
            this.adjacencyList[vertex1].push({ node: vertex2, weight });  //undirected graph
            this.adjacencyList[vertex2].push({ node: vertex1, weight });
          }
          Dijkstra(start, end) {
            //initialise start
            const nodes = new PriorityQueue(); //used to take the shortest distance node in dijkstra algorithm
            const distances = {}; //nodes and distance table
            const previous = {}; //previous element route
            let path = []; //to return at end
            let smallest;

            for (let vertex in this.adjacencyList) {
              if (vertex === start) {
                distances[vertex] = 0;
                nodes.enqueue(vertex, 0);
              } else {
                distances[vertex] = Infinity;
                nodes.enqueue(vertex, Infinity);
              }
              previous[vertex] = null;
            }
            //initialise end
            while (nodes.values.length) {
              //loop until there are nodes to visit
              smallest = nodes.dequeue().val;
              if (smallest === end) {
                while (previous[smallest]) {
                  path.push(smallest);
                  smallest = previous[smallest];
                }
                break;
              }
              if (smallest || distances[smallest] !== Infinity) {
                for (let neighbor in this.adjacencyList[smallest]) {
                  let nextNode = this.adjacencyList[smallest][neighbor];
                  let candidate = distances[smallest] + nextNode.weight;
                  let nextNeighbor = nextNode.node;
                  if (candidate < distances[nextNeighbor]) {
                    distances[nextNeighbor] = candidate;
                    previous[nextNeighbor] = smallest;
                    nodes.enqueue(nextNeighbor, candidate);
                  }
                }
              }
            }
            //Start
            let totalDistance = distances[end];
            document.getElementById("distanceCost").innerHTML = totalDistance*10;
            document.getElementById("deliveryCost").style.display = "block";
            document.getElementById("deliveryCost1").style.display = "block";
            //End
            return path.concat(smallest).reverse();
          }
        }

        var graph = new WeightedGraph();
        graph.addVertex("L");
        graph.addVertex("H1");
        graph.addVertex("H2");
        graph.addVertex("H3");
        graph.addVertex("H4");
        graph.addVertex("H4");
        graph.addVertex("H5");
        graph.addVertex("H6");
        graph.addVertex("H7");
        graph.addVertex("H8");

        graph.addEdge("L", "H1", 8);
        graph.addEdge("L", "H2", 6);
        graph.addEdge("L", "H3", 10);
        graph.addEdge("L", "H4", 1);
        graph.addEdge("L", "H5", 2);
        graph.addEdge("L", "H7", 4);
        graph.addEdge("H1", "H2", 5);
        graph.addEdge("H1", "H3", 9);
        graph.addEdge("H2", "H4", 4);
        graph.addEdge("H3", "H8", 5);
        graph.addEdge("H4", "H5", 6);
        graph.addEdge("H4", "H6", 8);
        graph.addEdge("H5", "H7", 3);
        graph.addEdge("H5", "H6", 3);
        graph.addEdge("H6", "H8", 9);
        graph.addEdge("H7", "H8", 3);
        graph.addEdge("H7", "H3", 3);

        //document.getElementById("output").innerHTML = graph.Dijkstra("L", dest);
        var somethings = graph.Dijkstra("L", dest);
        var outputString = "";
        for(let i=0;i<somethings.length-1;i++)
        {
          outputString+=somethings[i] + "->";
        }
        outputString+=somethings[somethings.length-1];
        document.getElementById("output").innerHTML = outputString;
      }
    </script>
  </head>
  <body>
    <div class="nav-bar">
      <h2>Infinite Learn</h2>
      <div class="Links">
        <a href="Logout.php">Sign Out</a>
      </div>
    </div>
    <div class="Delivery">
      <h3>Delivery</h3>
      <p>
        We deliver to all addresses within 10 km radius from our Library.<br />You
        can select your house from the given addresses in the Map that covers 10
        km radius from our Library.
      </p>
      <img
        src="Map2.PNG"
        alt="Map"
        id="DSASampleMap"
        height="522"
        width="630"
      />
      <br />
      <p>
        Select your Delivery address:
        <select id="Destination">
          <option value="H1">H1</option>
          <option value="H2">H2</option>
          <option value="H3">H3</option>
          <option value="H4">H4</option>
          <option value="H5">H5</option>
          <option value="H6">H6</option>
          <option value="H7">H7</option>
          <option value="H8">H8</option>
        </select>
      </p>
      <input
        type="submit"
        value="Find Shortest Route"
        class="myButton"
        onclick="DijkstrasAlgo()"
      />
      <p id="deliveryCost1" style="display: none">The Shortest Route is: <span id="output"></span></p>
      <p id="deliveryCost" style="display: none">
        We charge Rs.10 for every 1km distance, Hence the deliver charge is:
        Rs.<span id="distanceCost"></span> <br> The Delivery charges must be paid on delivery.
      </p>
    </div>
  </body>
</html>
