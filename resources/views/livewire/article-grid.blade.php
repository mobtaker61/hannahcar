<div>
    <!-- Filters -->
    <div class="row mb-4">
        <div class="col-md-4">
            <input type="text" wire:model.live="search" class="form-control" placeholder="جستجو در مقالات...">
        </div>
        <div class="col-md-3">
            <select wire:model.live="category" class="form-select">
                <option value="">همه دسته‌ها</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select wire:model.live="sortBy" class="form-select">
                <option value="latest">جدیدترین</option>
                <option value="popular">محبوب‌ترین</option>
                <option value="featured">ویژه</option>
            </select>
        </div>
        <div class="col-md-2">
            <select wire:model.live="perPage" class="form-select">
                <option value="6">6 مقاله</option>
                <option value="12">12 مقاله</option>
                <option value="24">24 مقاله</option>
            </select>
        </div>
    </div>

    <!-- Articles Grid -->
    @if($articles->count() > 0)
        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if($article->featured_image)
                            <img src="{{ asset('storage/' . $article->featured_image) }}"
                                 class="card-img-top" alt="{{ $article->title }}"
                                 style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            @if($article->category)
                                <span class="badge bg-primary mb-2">{{ $article->category->name }}</span>
                            @endif
                            <h5 class="card-title">{{ $article->title }}</h5>
                            @if($article->excerpt)
                                <p class="card-text text-muted">{{ $article->excerpt }}</p>
                            @endif
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-calendar"></i>
                                    {{ $article->published_at->format('Y/m/d') }}
                                </small>
                                <a href="{{ route('news.show', $article->slug) }}" class="btn btn-outline-primary btn-sm">
                                    ادامه مطلب
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $articles->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
            <h4 class="text-muted">هیچ مقاله‌ای یافت نشد</h4>
            <p class="text-muted">لطفا فیلترهای خود را تغییر دهید.</p>
        </div>
    @endif
</div>
