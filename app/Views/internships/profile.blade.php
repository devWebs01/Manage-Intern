 <div class="row">
    
     <div class="col-12">

         <div class="card">
             <div class="card-header">
                 <h5>Personal Details</h5>
             </div>
             <div class="card-body">
                 <ul class="list-group list-group-flush">
                     <li class="list-group-item px-0 pt-0">
                         <div class="row">
                             <div class="col-md-6">
                                 <p class="mb-1 text-muted">Nama Lengkap</p>
                                 <p class="mb-0">{{ $participant->full_name }}</p>
                             </div>
                             <div class="col-md-6">
                                 <p class="mb-1 text-muted">Pendidikan</p>
                                 <p class="mb-0">{{ $participant->institution }}</p>
                             </div>
                         </div>
                     </li>
                     <li class="list-group-item px-0">
                         <div class="row">
                             <div class="col-md-6">
                                 <p class="mb-1 text-muted">Tingkat</p>
                                 <p class="mb-0">{{ $participant->level }}</p>
                             </div>
                             <div class="col-md-6">
                                 <p class="mb-1 text-muted">Status</p>
                                 <p class="mb-0">{{ $participant->status }}</p>
                             </div>
                         </div>
                     </li>
                     <li class="list-group-item px-0">
                         <div class="row">
                             <div class="col-md-6">
                                 <p class="mb-1 text-muted">Tanggal Mulai</p>
                                 <p class="mb-0">
                                     {{ date('d-m-Y', strtotime($participant->start_date)) }}</p>
                             </div>
                             <div class="col-md-6">
                                 <p class="mb-1 text-muted">Tanggal Akhir</p>
                                 <p class="mb-0">
                                     {{ date('d-m-Y', strtotime($participant->end_date)) }}</p>
                             </div>
                         </div>
                     </li>
                     <li class="list-group-item px-0">
                         <div class="row">
                             <div class="col-md-6">
                                 <p class="mb-1 text-muted">Email</p>
                                 <p class="mb-0">{{ $participant->user->email }}</p>
                             </div>
                             <div class="col-md-6">
                                 <p class="mb-1 text-muted">Username</p>
                                 <p class="mb-0">{{ $participant->user->username }}</p>
                             </div>
                         </div>
                     </li>
                     <li class="list-group-item px-0 pb-0">
                         <p class="mb-1 text-muted">Status Akun</p>
                         <p class="mb-0">{{ $participant->status }}</p>
                     </li>
                 </ul>
             </div>
         </div>

     </div>
 </div>
