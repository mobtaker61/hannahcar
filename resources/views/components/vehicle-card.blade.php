@php
    $isRtl = in_array(app()->getLocale(), ['fa', 'ar']);
    $kmNumeric = (float) preg_replace('/[^0-9.]/', '', (string) ($km ?? ''));
    $priceNumeric = (float) preg_replace('/[^0-9.]/', '', (string) ($price ?? ''));
    $badgeText = $badge ?? ($year ?? '');
@endphp

@once
    <style>
        .vc-image {
            width: 100%;
            height: 192px;
            object-fit: cover
        }

        .vc-name {
            font-size: 18px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
            line-height: 1.3
        }

        .vc-spec-row {
            background: #E9EAEB;
            border-radius: 10px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            padding: 14px
        }

        .vc-spec-col {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 6px;
            color: #A5A5A5
        }

        .vc-spec-col i {
            font-size: 18px;
            color: #A5A5A5
        }

        .vc-spec-col .value {
            font-size: 16px;
            font-weight: 800;
            color: #6B7280
        }

        .vc-price-row {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 12px
        }

        .vc-price-badge {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 15px 30px -10px rgba(0, 0, 0, .08)
        }

        .vc-price-text {
            font-size: 24px;
            font-weight: 700;
            color: #32D583
        }

        .vc-divider {
            height: 1px;
            background: #E9EAEB;
            margin: 14px 0
        }

        .vc-view-link {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #535862;
            font-weight: 600
        }
    </style>
@endonce

<div class="vehicle-card flex-shrink-0 snap-start">
    <a href="{{ $url ?? '#' }}" class="block">
        <div class="relative">
            <img src="{{ $image }}" alt="{{ $name }}" class="vc-image">
            <div
                class="absolute top-3 {{ $isRtl ? 'right-3' : 'left-3' }} bg-white/90 backdrop-blur-sm text-gray-800 px-2 py-1 rounded text-xs font-semibold">
                {{ $badgeText }}
            </div>
        </div>

        <div class="p-4">
            <h3 class="vc-name text-center">{{ $name }}</h3>

            <div class="vc-spec-row mt-3">
                <div class="vc-spec-col">
                    <i class="fas fa-gauge"></i>
                    <div class="value">{{ number_format($kmNumeric) }}</div>
                </div>
                <div class="vc-spec-col">
                    <i class="fas fa-calendar-alt"></i>
                    <div class="value">{{ $year }}</div>
                </div>
                <div class="vc-spec-col">
                    <i class="fas fa-car"></i>
                    <div class="value">{{ __('Healthy') }}</div>
                </div>
            </div>

            <div class="vc-price-row">
                <div class="vc-price-text">
                    {{ number_format($priceNumeric) }}{{ !empty($currency) ? ' ' . $currency : '' }}</div>
            </div>
        </div>
    </a>
</div>
