<h1>API List</h1>

<a href="/ui/api/add" class="btn btn-primary">
    <i class="fas fa-plus"></i> Add API
</a>

<br />
<br />

<table class="table">
<thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Name</th>
    <th scope="col">Title</th>
    <th scope="col">Url</th>
    <th scope="col">Response results accessor</th>
    <th scope="col">Response row lat accessor</th>
    <th scope="col">Response row lng accessor</th>
    <th scope="col">Action</th>
</tr>
</thead>
<tbody>
    <?php foreach ($apis as $api) { ?>
        <tr>
            <th scope="row"><?php echo $api['id']; ?></th>
            <td><?php echo $api['name']; ?></td>
            <td><?php echo $api['title']; ?></td>
            <td><?php echo $api['url']; ?></td>
            <td><?php echo $api['response_results_accessor']; ?></td>
            <td><?php echo $api['response_row_lat_accessor']; ?></td>
            <td><?php echo $api['response_row_lng_accessor']; ?></td>
            <td>
                <a href="/ui/api/edit/<?php echo $api['id']; ?>" class="btn btn-success">
                    <i class="fas fa-edit"></i> 
                </a>
                <a href="/ui/api/delete/<?php echo $api['id']; ?>" class="btn btn-danger">
                    <i class="fas fa-trash"></i> 
                </a>
            </td>
        </tr>
    <?php } ?>
</tbody>
</table>
