@if (count(\Laravel\Nova\Nova::resourcesForNavigation(request())))
{{-- <pre> --}}
    @foreach ($navigation as $group => $resources)
        @if (count($groups) > 1)
            <div style="display:flex;">
                    <i style="color:#9fa6ac" class="mx-1 fa-solid {{ $icons[strtolower($group)] }} "></i>
                <h4 class=" mt-1 mx-1 mb-3 text-xs text-white-50% uppercase tracking-wide">{{ $group }}</h4>
            </div>
        @endif

        <ul class="list-reset mb-8">
            @foreach ($resources as $resource)
                <li class="leading-tight mb-4 ml-8 text-sm">
                    <router-link :to="{
                        name: 'index',
                        params: {
                            resourceName: '{{ $resource::uriKey() }}'
                        }
                    }" class="text-white text-justify no-underline dim"
                        dusk="{{ $resource::uriKey() }}-resource-link">
                        {{ $resource::label() }}
                    </router-link>
                </li>
            @endforeach
        </ul>
    @endforeach
@endif
