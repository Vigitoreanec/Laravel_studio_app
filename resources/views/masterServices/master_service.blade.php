@if($master->services->isNotEmpty())
    <div class="mt-4">
        <h5 class="mb-3">Предоставляемые услуги:</h5>
        <div class="row row-cols-1 row-cols-md-2 g-3">
            @foreach($master->services as $service)
                <div class="col">
                    <div class="card service-card h-100 border-primary">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-primary">
                                {{ $service->category->name }}
                            </h6>
                            <p class="card-text">
                                {{ $service->description ?? 'Профессиональное выполнение услуги' }}
                            </p>
                            <div class="d-flex justify-content-around align-items-center flex-direction-column">
                                <span class="badge bg-success fs-6">
                                    {{ number_format($service->price, 0, ',', ' ') }} руб.
                                </span>
                                <button class="btn btn-sm btn-outline-primary book-btn" data-master-id="{{ $master->id }}"
                                    data-service-id="{{ $service->id }}" data-bs-toggle="modal" data-bs-target="#bookingModal">
                                    Записаться
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="mt-4 alert alert-info">
        У этого мастера пока нет доступных услуг
    </div>
@endif