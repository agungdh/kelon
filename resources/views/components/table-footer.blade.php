<div class="flex justify-between items-center">
    <span>Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}</span>
    <span>Total Records: {{ $paginator->total() }}</span>
</div>
