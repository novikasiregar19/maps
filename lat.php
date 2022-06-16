<?php include 'date.php'?>
<div class="container">
    <table id="dataTables" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>datetime</th>
            <th>datetime update</th>
            <th>day 1</th>
            <th>day 2</th>
            <th>day 3</th>
            <th>day 4</th>
            <th>day 5</th>
            <th>day 6</th>
            <th>day 7</th>
            <th>day 8</th>
            <th>day 9</th>
            <th>day 10</th>
            <th>day 11</th>
            <th>day 12</th>
            <th>day 13</th>
            <th>day 14</th>
            <th>day 15</th>
            <th>day 16</th>
            <th>day 17</th>
            <th>day 18</th>
            <th>day 19</th>
            <th>day 20</th>
            <th>day 21</th>
            <th>day 22</th>
            <th>day 23</th>
            <th>day 24</th>
            <th>day 25</th>
            <th>day 26</th>
            <th>day 27</th>
            <th>day 28</th>
            <th>day 29</th>
            <th>day 30</th>
            <th>day 31</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        include 'koneksi.php';
        if(isset($_GET['date']))
        {
        $date = $_GET['date'];
        $trans_tot = mysqli_query($conn, "SELECT * FROM trans_tot WHERE datetime_a");
        $date_hasil = mysqli_query($con, $trans_tot);

        if(mysqli_num_rows($trans_tot) > 0)
        {
            foreach($query_run as $row)
            {
                ?>
            <tr>
                <td><?=$rows['datetime_a']; ?></td>
                <td><?=$rows['datetime_update']; ?></td>
                <td><?=$rows['day1']; ?></td>
                <td><?=$rows['day2']; ?></td>
                <td><?=$rows['day3']; ?></td>
                <td><?=$rows['day4']; ?></td>
                <td><?=$rows['day5']; ?></td>
                <td><?=$rows['day6']; ?></td>
                <td><?=$rows['day7']; ?></td>
                <td><?=$rows['day8']; ?></td>
                <td><?=$rows['day9']; ?></td>
                <td><?=$rows['day10']; ?></td>
                <td><?=$rows['day11']; ?></td>
                <td><?=$rows['day12']; ?></td>
                <td><?=$rows['day13']; ?></td>
                <td><?=$rows['day14']; ?></td>
                <td><?=$rows['day15']; ?></td>
                <td><?=$rows['day16']; ?></td>
                <td><?=$rows['day17']; ?></td>
                <td><?=$rows['day18'];?> </td>
                <td><?=$rows['day19']; ?></td>
                <td><?=$rows['day20']; ?></td>
                <td><?=$rows['day21']; ?></td>
                <td><?=$rows['day22']; ?></td>
                <td><?=$rows['day23']; ?></td>
                <td><?=$rows['day24']; ?></td>
                <td><?=$rows['day25']; ?></td>
                <td><?=$rows['day26']; ?></td>
                <td><?=$rows['day26']; ?></td>
                <td><?=$rows['day28']; ?></td>
                <td><?=$rows['day29']; ?></td>
                <td><?=$rows['day20']; ?></td>
                <td><?=$rows['day31']; ?></td>
                </tr>
                <?php
                 }
             }
                else
             {
                    echo "No Record Found";
                    }
        }
    ?>
    </tbody>
    </table>
    </div>