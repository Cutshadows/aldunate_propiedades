<?//session_start();
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "Q1a2z3w4S5croot");
define("DB_NAME", "bdaldunate");
define('DB_CHARSET', 'utf-8');
date_default_timezone_set('America/Santiago');

function conectar()
{
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    mysqli_select_db($conn, DB_NAME);

    if ($conn->connect_error) {
        echo $error = $conn->connect_error;

    }
    return $conn;
}