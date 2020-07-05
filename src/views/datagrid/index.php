<form action="/datagrid" method="GET">
    <table id="renderTable" class='table table-lg table-bordered p-0 m-0'>
        <thead>
            <tr>
                <?= $tableHead; ?>
            </tr>
        </thead>
        <tbody>
            <?= $tableBody; ?>
        </tbody>
    </table>
    <div class="d-flex-column align-items-center text-center justify-content-center">
        <nav aria-label="..." class="d-flex justify-content-center pt-2">
            <ul class="pagination d-flex p-0 m-0 flex-wrap">
                <?= $pagInput; ?>
            </ul>
        </nav>
        <div class="pt-2 d-flex-inline align-items-center justify-content-center">
            <div><label for="rows">Il. wierszy: </label><?= $rows; ?></div>
            <div><button type="submit" class="btn btn-link">Renderuj</button></div>
        </div>
    </div>
</form>