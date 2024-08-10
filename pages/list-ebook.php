<?php
require_once('./class/class.ebook.php');
require_once('./components/modal.php');

$objEbook = new Ebook();
$ebooks = $objEbook->SelectAllEbooks();
?>

<table class="table table-bordered">
    <thead class="text-center align-middle">
        <tr>
            <th>No</th>
            <th>E-Book Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="text-center align-middle">
        <?php
        $no = 1;
        foreach ($ebooks as $ebook) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $ebook->name . "</td>";
            echo "<td> 
                <button class='btn btn-primary mb-2' 
                        onclick='viewPDF(\"" . $ebook->file_path . "\", \"" . $ebook->name . "\")' 
                        title='View PDF'>
                    <i class='bi bi-eye'></i>
                </button> 
                <button class='btn btn-danger mb-2' 
                        onclick='confirmDelete(" . $ebook->id . ")' 
                        title='Delete eBook'>
                    <i class='bi bi-trash'></i>
                </button> 
            </td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>