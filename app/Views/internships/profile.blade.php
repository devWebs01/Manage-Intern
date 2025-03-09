 <div class="row">
     <div class="col-lg-4 col-xxl-3">
         <div class="card">
             <div class="card-body position-relative">
                 <div class="text-center mt-3">
                     <div class="chat-avtar d-inline-flex mx-auto">
                         <img class="rounded-circle img-fluid wid-70"
                             src="https://api.dicebear.com/9.x/adventurer/svg?seed={{ $participant->full_name }}"
                             alt="User image">
                     </div>
                     <h5 class="mb-0">{{ $participant->full_name }}</h5>

                 </div>
             </div>
         </div>
         <div class="card">
             <div class="card-header">
                 <h5>Skills</h5>
             </div>
             <div class="card-body">
                 <div class="row align-items-center mb-3">
                     <div class="col-sm-6 mb-2 mb-sm-0">
                         <p class="mb-0">Junior</p>
                     </div>
                     <div class="col-sm-6">
                         <div class="d-flex align-items-center">
                             <div class="flex-grow-1 me-3">
                                 <div class="progress progress-primary" style="height: 6px;">
                                     <div class="progress-bar" style="width: 30%;"></div>
                                 </div>
                             </div>
                             <div class="flex-shrink-0">
                                 <p class="mb-0 text-muted">30%</p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="row align-items-center mb-3">
                     <div class="col-sm-6 mb-2 mb-sm-0">
                         <p class="mb-0">UX Researcher</p>
                     </div>
                     <div class="col-sm-6">
                         <div class="d-flex align-items-center">
                             <div class="flex-grow-1 me-3">
                                 <div class="progress progress-primary" style="height: 6px;">
                                     <div class="progress-bar" style="width: 80%;"></div>
                                 </div>
                             </div>
                             <div class="flex-shrink-0">
                                 <p class="mb-0 text-muted">80%</p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="row align-items-center mb-3">
                     <div class="col-sm-6 mb-2 mb-sm-0">
                         <p class="mb-0">Wordpress</p>
                     </div>
                     <div class="col-sm-6">
                         <div class="d-flex align-items-center">
                             <div class="flex-grow-1 me-3">
                                 <div class="progress progress-primary" style="height: 6px;">
                                     <div class="progress-bar" style="width: 90%;"></div>
                                 </div>
                             </div>
                             <div class="flex-shrink-0">
                                 <p class="mb-0 text-muted">90%</p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="row align-items-center mb-3">
                     <div class="col-sm-6 mb-2 mb-sm-0">
                         <p class="mb-0">HTML</p>
                     </div>
                     <div class="col-sm-6">
                         <div class="d-flex align-items-center">
                             <div class="flex-grow-1 me-3">
                                 <div class="progress progress-primary" style="height: 6px;">
                                     <div class="progress-bar" style="width: 30%;"></div>
                                 </div>
                             </div>
                             <div class="flex-shrink-0">
                                 <p class="mb-0 text-muted">30%</p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="row align-items-center mb-3">
                     <div class="col-sm-6 mb-2 mb-sm-0">
                         <p class="mb-0">Graphic Design</p>
                     </div>
                     <div class="col-sm-6">
                         <div class="d-flex align-items-center">
                             <div class="flex-grow-1 me-3">
                                 <div class="progress progress-primary" style="height: 6px;">
                                     <div class="progress-bar" style="width: 95%;"></div>
                                 </div>
                             </div>
                             <div class="flex-shrink-0">
                                 <p class="mb-0 text-muted">95%</p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="row align-items-center">
                     <div class="col-sm-6 mb-2 mb-sm-0">
                         <p class="mb-0">Code Style</p>
                     </div>
                     <div class="col-sm-6">
                         <div class="d-flex align-items-center">
                             <div class="flex-grow-1 me-3">
                                 <div class="progress progress-primary" style="height: 6px;">
                                     <div class="progress-bar" style="width: 75%;"></div>
                                 </div>
                             </div>
                             <div class="flex-shrink-0">
                                 <p class="mb-0 text-muted">75%</p>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="col-lg-8 col-xxl-9">

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
