@if($pengajuan->surat_pengantar_rt_rw)
<div class="text-justify" style="margin-top: 10px;">
    <b>Surat Pengantar dari RT/RW:</b><br>
    {{ $pengajuan->surat_pengantar_rt_rw ?? '-' }}
</div>
@endif

