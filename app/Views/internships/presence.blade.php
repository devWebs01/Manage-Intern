 <div class="table-responsive">
     <p class="text-center fw-bold">Data Absensi</p>
     <table class="table table-striped text-nowrap" style="width:100%">
         <thead>
             <tr>
                 <th>No.</th>
                 <th>Tanggal</th>
                 <th>Jam Masuk</th>
                 <th>Jam Keluar</th>
             </tr>
         </thead>
         <tbody>
             @foreach ($presences as $no => $presence)
                 <tr>
                     <td>{{ ++$no }}</td>
                     <td>{{ Carbon\Carbon::parse($presence->date)->format("d M Y") }}</td>
                     <td>{{ $presence->check_in }}</td>
                     <td>{{ $presence->check_out }}</td>
                 </tr>
             @endforeach
         </tbody>
     </table>
 </div>
