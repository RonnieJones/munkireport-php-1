<table class="appusage table table-striped table-bordered">
	<thead>
		<tr>
            <th data-i18n="appusage.appname"></th>
            <th data-i18n="appusage.event"></th>
            <th data-i18n="appusage.lastevent"></th>
            <th data-i18n="appusage.count"></th>
            <th data-i18n="version"></th>
            <th data-i18n="path"></th>
            <th data-i18n="bundle_id"></th>
		</tr>
	</thead>
	<tbody>
    @foreach($appusage as $item)
      <?php $name_url=url('module/inventory/items/'. rawurlencode($item->app_name)); ?>
        <tr>
          <td><a href='{{ $name_url }}'>{{ $item->app_name }}</a></td>
          <td>{{ str_replace(array('quit','launch','activate'), array('Quit','Launch','Activation'), $item->event) }}</td>
          <td>{{ $item->last_time }}</td>
          <td>{{ $item->number_times }}</td>
          <td>{{ $item->app_version }}</td>
          <td>{{ $item->app_path }}</td>
          <td>{{ $item->bundle_id }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
  $(document).on('appReady', function(e, lang) {

        // Initialize datatables
            $('.appusage').dataTable({
                "bServerSide": false,
                "aaSorting": [[0,'asc']]
            });
  });
</script>
