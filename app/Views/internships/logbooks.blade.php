 <div class="table-responsive">
                                <p class="text-center fw-bold">Data Logbook</p>

                                <table class="table table-striped text-nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal</th>
                                            <th>Isi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logbooks as $no => $logbook)
                                            <tr>
                                                <td>{{ ++$no }}</td>
                                                <td>{{ Carbon\Carbon::parse($logbook->date)->format("d M Y") }}</td>
                                                <td>{{ Illuminate\Support\Str::limit($logbook->activity, 40, "...") }}</td>
                                                <td>
                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <a href="{{ site_url("logbooks/" . $logbook->id . "/edit") }}"
                                                            class="btn btn-sm btn-sm btn-warning">Edit</a>

                                                        <form action="{{ site_url("logbooks/" . $logbook->id) }}"
                                                            method="post"
                                                            onsubmit="return confirm('Yakin ingin menghapus?');">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>