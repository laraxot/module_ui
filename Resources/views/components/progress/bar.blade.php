{{ $value }} %
<div class="progress progress-striped active" style="height:5px;">
    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0"
        aria-valuemax="100" style="width: {{ $value }}%;">
        <span class="sr-only">{{ $value }}% Complete (success)</span>
    </div>
</div>