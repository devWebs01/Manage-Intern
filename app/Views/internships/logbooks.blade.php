 <div class="table-responsive">
     <p class="text-center fw-bold">Data Logbook</p>

     <table class="table table-striped text-nowrap" style="width:100%">
         <thead>
             <tr>
                 <th>No.</th>
                 <th>Username</th>
                 <th>Nama Lengkap</th>
                 <th>Tanggal</th>
                 <th>Aksi</th>
             </tr>
         </thead>
         <tbody>
             @foreach ($logbooks as $no => $logbook)
                 <tr>
                     <td>{{ ++$no }}</td>
                     <td>{{ $logbook->participant->user->username }}</td>
                     <td>{{ $logbook->participant->full_name }}</td>
                     <td>{{ Carbon\Carbon::parse($logbook->date)->format("d M Y") }}</td>
                     <td>
                         <div class="d-flex gap-2 justify-content-center">
                             <a href="{{ site_url("logbooks/" . $logbook->id . "/show") }}"
                                 class="btn btn-sm btn-sm btn-warning">Lihat</a>
                         </div>
                     </td>
                 </tr>
             @endforeach
         </tbody>
     </table>
 </div>
