<?php
function renderPopularLocation($heading, $src) {
    return "
        <div class='col-md-3 mb-4'>
            <div class='card'>
                <div class='newly'>
                    <div class='card-img-overlay'>
                        <h5 class='card-title-overlay loc'>$heading</h5>
                    </div>
                    <img src='$src' class='card-img-top' alt='$heading' width='400px' height='200px'>
                </div>
                <div class='card-body'>
                    <button type='submit' class='btn btn-primary w-100'>Learn more</button>
                </div>
            </div>
        </div>
    ";
}

$locations = [
    ['heading' => 'Goa', 'src' => 'images/location1.jpg'],
    ['heading' => 'Jammu & <br> Kashmir', 'src' => 'images/location2.jpg'],
    ['heading' => 'UttraKhand', 'src' => 'images/location3.jpg'],
    ['heading' => 'Himachal Pradesh', 'src' => 'images/location4.jpg'],
];

foreach ($locations as $location) {
    echo renderPopularLocation($location['heading'], $location['src']);
}
?>
