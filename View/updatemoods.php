<?php
include_once '../config.php';

$pdo = config::getConnexion();

function updateProduct()
{
    global $pdo;
    if ($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['UserID'])) {
            $UserID = $_GET['UserID'];

            try {
                $query = $pdo->prepare("SELECT * FROM today_moods WHERE UserID = :UserID");
                $query->execute(['UserID' => $UserID]);
                $product = $query->fetch(PDO::FETCH_ASSOC);

                if ($product) {
?>
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <link rel="stylesheet" href="./css/style.css">
                    </head>
                    <body>

                    <form method="POST" action="processupdate.php">
                        <input type="hidden" name="UserID" value="<?php echo $UserID;?>">
                        <h2>What would you like to change? </h2>
                        <ul class="feedback">
                            <li class="angry">
                                <div>
                                    <svg class="eye left">
                                        <use xlink:href="#eye">
                                    </svg>
                                    <svg class="eye right">
                                        <use xlink:href="#eye">
                                    </svg>
                                    <svg class="mouth">
                                        <use xlink:href="#mouth">
                                    </svg>
                                </div>
                            </li>
                            <li class="sad">
                                <div>
                                    <svg class="eye left">
                                        <use xlink:href="#eye">
                                    </svg>
                                    <svg class="eye right">
                                        <use xlink:href="#eye">
                                    </svg>
                                    <svg class="mouth">
                                        <use xlink:href="#mouth">
                                    </svg>
                                </div>
                            </li>
                            <li class="ok">
                                <div></div>
                            </li>
                            <li class="good active">
                                <div>
                                    <svg class="eye left">
                                        <use xlink:href="#eye">
                                    </svg>
                                    <svg class="eye right">
                                        <use xlink:href="#eye">
                                    </svg>
                                    <svg class="mouth">
                                        <use xlink:href="#mouth">
                                    </svg>
                                </div>
                            </li>
                            <li class="happy">
                                <div>
                                    <svg class="eye left">
                                        <use xlink:href="#eye">
                                    </svg>
                                    <svg class="eye right">
                                        <use xlink:href="#eye">
                                    </svg>
                                </div>
                            </li>
                        </ul>
                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 7 4" id="eye">
                                <path d="M1,1 C1.83333333,2.16666667 2.66666667,2.75 3.5,2.75 C4.33333333,2.75 5.16666667,2.16666667 6,1"></path>
                            </symbol>
                            <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 7" id="mouth">
                                <path d="M1,5.5 C3.66666667,2.5 6.33333333,1 9,1 C11.6666667,1 14.3333333,2.5 17,5.5"></path>
                            </symbol>
                        </svg>
                        <div id="mood-container">
                            <h2>What words better describe
                                <br>you today?</h2>
                            <div class="mood-option" onclick="addMood('Happy')" id="happyBtn">Happy</div>
                            <div class="mood-option" onclick="addMood('Sad')" id="sadBtn">Sad</div>
                            <div class="mood-option" onclick="addMood('Depressed')" id="depressedBtn">Depressed</div>
                            <div class="mood-option" onclick="addMood('Angry')" id="angryBtn">Angry</div>
                            <br>
                            <div class="mood-option" onclick="addMood('Anxious')" id="anxiousBtn">Anxious</div>
                            <div class="mood-option" onclick="addMood('Excited')" id="excitedBtn">Excited</div>
                            <div class="mood-option" onclick="addMood('Tired')" id="tiredBtn">Tired</div>
                            <div class="mood-option" onclick="addMood('Stressed')" id="stressedBtn">Stressed</div>



                            <div id="selected-moods">
                                <h2>Your Selected Moods:</h2>
                                <ul id="mood-list"></ul>
                            </div>
                            <div id="talk-about-it">
                                <h2>Do you want to talk about it?</h2>
                                <textarea id="talk-textarea" placeholder="Write here..." name="talkaboutit"></textarea>
                                <button id="submit-btn">Submit</button>
                            </div>
                        </div>
                    </form>


                    <script src="./js/script.js"></script>
                    </body>
                    </html>


<?php
                } else {
                    echo "Product not found.";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Invalid request.";
        }
    } else {
        echo "Error: Unable to connect to the database.";
    }
}

// Call the function to update a product
updateProduct();

// Redirect without output buffering
exit();
?>