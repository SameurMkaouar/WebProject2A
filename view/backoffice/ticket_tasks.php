<?php
include_once '../../config.php';
$pdo = config::getConnexion();
if ($pdo) {
    $query = $pdo->query("SELECT * FROM ticket");
    $tickets = $query->fetchAll(PDO::FETCH_ASSOC);

    $query1=$pdo->query("SELECT * FROM reponse");
    $reponses=$query1->fetchAll(PDO::FETCH_ASSOC);

    $feedbackCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
    $totalFeedbackCount = 0;

    foreach ($reponses as $reponse) {
        $feedbackValue = $reponse['feedback'];

        // Only consider non-null and valid feedback values
        if ($feedbackValue !== null && array_key_exists($feedbackValue, $feedbackCounts)) {
            $feedbackCounts[$feedbackValue]++;
            $totalFeedbackCount++;
        }
    }

    $customerSatisfactionPercentage = 0;
    $Nombrededone=0;
    foreach ($tickets as $ticket) {
       foreach  ($reponses as $reponse) {
           if ($ticket['ticketid'] == $reponse['ticketid']) {
                $Nombrededone++;
                break;
           }
       }
    }
    $Nombredeticket = count($tickets);

    $ratio =number_format( $Nombrededone / $Nombredeticket * 100,0);
    if ($totalFeedbackCount > 0) {
        // Calculate the percentage of each feedback category
        $satisfactionValues = [1 => 'angry', 2 => 'sad', 3 => 'ok', 4 => 'good', 5 => 'happy'];

        $replytimeprediction = 0;
        $ticketCountWithReplies = 0; // Counter for tickets with at least one reply

        foreach ($tickets as $ticket) {
            $hasFirstReply = false; // Flag to check if the first reply is found for the current ticket

            foreach ($reponses as $reponse) {
                if ($ticket['ticketid'] == $reponse['ticketid'] && !$hasFirstReply) {
                    $replytimeprediction += (strtotime($reponse['reponsedate']) - strtotime($ticket['date']));
                    $hasFirstReply = true;
                    $ticketCountWithReplies++;
                }
            }
        }

        // Check if there are responses before calculating average
        if ($ticketCountWithReplies > 0) {
            $replytimeprediction = $replytimeprediction / $ticketCountWithReplies;

            // Convert reply time to days, hours, and minutes
            $replytimepredictionDays = floor($replytimeprediction / (24 * 3600));
            $replytimepredictionHours = floor(($replytimeprediction % (24 * 3600)) / 3600);
            $replytimepredictionMinutes = round(($replytimeprediction % 3600) / 60);

            // Build the output message
            $outputMessage = "Average Reply Time: ";

            if ($replytimepredictionDays > 1) {
                $outputMessage .= "{$replytimepredictionDays} days, ";
            } elseif ($replytimepredictionDays == 1) {
                $outputMessage .= "{$replytimepredictionDays} day, ";
            }

            $outputMessage .= "{$replytimepredictionHours} hours, and {$replytimepredictionMinutes} minutes";

        } else {
            // Handle case where there are no responses
            $outputMessage = "No replies available to calculate average reply time prediction.";
        }


        // Calculate statistics for today, this week, and this month
        $ticketsToday = 0;
        $ticketsThisWeek = 0;
        $ticketsThisMonth = 0;

        $today = strtotime('today');
        $startOfWeek = strtotime('last monday', $today);
        $startOfMonth = strtotime('first day of this month', $today);

        foreach ($tickets as $ticket) {
            $ticketDate = strtotime($ticket['date']);

            if ($ticketDate >= $today) {
                $ticketsToday++;
            }

            if ($ticketDate >= $startOfWeek) {
                $ticketsThisWeek++;
            }

            if ($ticketDate >= $startOfMonth) {
                $ticketsThisMonth++;
            }
        }

    }


    $last7DaysTicketCounts = [];
    for ($i = 6; $i >= 0; $i--) {
        $currentDate = date('Y-m-d', strtotime("-$i days"));
        $ticketCount = 0;

        foreach ($tickets as $ticket) {
            $ticketDate = date('Y-m-d', strtotime($ticket['date']));

            if ($ticketDate == $currentDate) {
                $ticketCount++;
            }
        }

        $last7DaysTicketCounts[] = $ticketCount;
        $last7DaysLabels[] = date('D', strtotime($currentDate));;
    }

}



    ?>
        <style>
            li {
                margin-bottom: 8px;
            }
            .progress-bar-info {
                background-color: #5bc0de;
            }
            <style>
             .progress-indicator-container {
                 display: flex;
                 flex-direction: column;
                 align-items: center;
             }

            .progress-indicator {
                position: relative;
                width: 100px;
                height: 100px;
                border-radius: 50%;
                background-color: #f5f5f5;
            }

            .progress-fill {
                position: absolute;
                width: 50%;
                height: 100%;
                border-radius: 50%;
                background-color: #5bc0de; /* Adjust the color as needed */
            }

            .progress-label {
                margin-top: 10px;
                font-weight: bold;
            }
        </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



                                <li class="dropdown header-notes-dropdown">
                                    <a class="header-button" data-target="#" href="./" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                                        <i class="fa fa-calendar-o grey"></i>
                                        <span class="header-button-text">User</span>
                                    </a>
                                    <div class="dropdown-menu ls">

                                        <div class="dropdwon-menu-title with_background">
                                            <strong> Pending</strong> Tasks

                                            <div class="pull-right darklinks">
                                                <a href="#">View All</a>
                                            </div>

                                        </div>

                                        <ul class="list-unstyled">

                                            <li>
                                                <p class="progress-bar-title grey"> <strong>Customer Satisfaction Breakdown:</strong> </p>
                                                <ul>
                                                    <?php
                                                    if (is_array($satisfactionValues) && !empty($satisfactionValues)) {
                                                    foreach ($satisfactionValues as $value => $label) : ?>
                                                        <?php
                                                        $percentage = ($feedbackCounts[$value] / $totalFeedbackCount) * 100;
                                                        $customerSatisfactionPercentage += $percentage * $value; // Weighted sum for overall satisfaction
                                                        ?>
                                                        <li><?php echo "$label: " . number_format($percentage, 0) . "%"; ?></li>
                                                    <?php  endforeach; } ?>
                                                </ul>
                                                <?php
                                                $customerSatisfactionPercentage /= 5; // Normalize to get the average satisfaction percentage
                                                ?>
                                            </li>
                                            <li>
                                                <p class="progress-bar-title grey">
                                                    <strong>Overall Customer Satisfaction</strong>
                                                </p>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-success" role="progressbar" data-transitiongoal="<?php echo $customerSatisfactionPercentage; ?>">
                                                        <span><?php echo number_format($customerSatisfactionPercentage, 0); ?>%</span>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <p class="progress-bar-title grey">
                                                    <strong>Progress</strong>
                                                    <strong>(Done: <?php echo $Nombrededone ?> / Total: <?php echo $Nombredeticket?>)</strong>
                                                </p>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-info" role="progressbar" data-transitiongoal="<?php echo $ratio ?>">
                                                        <span><?php echo $ratio ?>%</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                            <canvas id="ticketChart" width="400" height="150"></canvas>
                                                <!--<canvas class="canvas-chart-line-daily-tickets" width="370" height="200"></canvas>-->
                                            </li>

                                            <!--<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


                                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                            <script>
                                                // Daily tickets for the last 7 days
                                                var $canvasesDailyTickets = jQuery('.canvas-chart-line-daily-tickets');
                                                if ($canvasesDailyTickets.length) {
                                                    $canvasesDailyTickets.each(function (i) {
                                                        var config = {
                                                            type: 'line',
                                                            data: {
                                                                labels: <?php echo json_encode($last7DaysLabels); ?>,
                                                                datasets: [{
                                                                    label: "Tickets per Day",
                                                                    backgroundColor: 'rgba(244, 161, 21, 0.5)',
                                                                    borderColor: 'rgba(244, 161, 21, 0.5)',
                                                                    borderWidth: '0',
                                                                    tension: '0',
                                                                    // Tickets per day for the last 7 days
                                                                    data: <?php echo json_encode($last7DaysTicketCounts); ?>,
                                                                    fill: true,
                                                                }]
                                                            },
                                                            options: {
                                                                responsive: false,
                                                                title: {
                                                                    display: true,
                                                                    text: 'Daily Tickets'
                                                                },
                                                                tooltips: {
                                                                    mode: 'index',
                                                                    intersect: false,
                                                                },
                                                                hover: {
                                                                    mode: 'nearest',
                                                                    intersect: true
                                                                },
                                                                scales: {
                                                                    xAxes: [{
                                                                        display: true,
                                                                        scaleLabel: {
                                                                            display: true,
                                                                            labelString: 'Day'
                                                                        }
                                                                    }],
                                                                    yAxes: [{
                                                                        display: true,
                                                                        scaleLabel: {
                                                                            display: true,
                                                                            labelString: 'Tickets'
                                                                        }
                                                                    }]
                                                                }
                                                            }
                                                        };

                                                        var canvas = jQuery(this)[0].getContext("2d");

                                                        new Chart(canvas, config);
                                                    });
                                                } // Daily tickets
                                            </script>
                                            -->
                                            <script>
                                                // Your JavaScript code for the bar chart
                                                var ctx = document.getElementById('ticketChart').getContext('2d');
                                                var myChart = new Chart(ctx, {
                                                    type: 'bar',
                                                    data: {
                                                        labels: ['Today', 'This Week', 'This Month'],
                                                        datasets: [{
                                                            label: 'Number of Tickets',
                                                            data: [<?php echo $ticketsToday; ?>, <?php echo $ticketsThisWeek; ?>, <?php echo $ticketsThisMonth; ?>],
                                                            backgroundColor: [
                                                                'rgba(75, 192, 192, 0.2)',
                                                                'rgba(255, 206, 86, 0.2)',
                                                                'rgba(255, 99, 132, 0.2)',
                                                            ],
                                                            borderColor: [
                                                                'rgba(75, 192, 192, 1)',
                                                                'rgba(255, 206, 86, 1)',
                                                                'rgba(255, 99, 132, 1)',
                                                            ],
                                                            borderWidth: 1
                                                        }]
                                                    },
                                                    options: {
                                                        scales: {
                                                            y: {
                                                                beginAtZero: true,
                                                            }
                                                        }

                                                    }
                                                });
                                            </script>

                                            <hr><li>
                                                <p class="progress-bar-title grey">
                                                    <strong> <center><?php echo $outputMessage?></center></strong>
                                                </p>

                                            </li>


                                        </ul>

                                    </div>

                                </li>


<?php?>