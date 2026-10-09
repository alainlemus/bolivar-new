@props(['items' => []])
@php $uid = \Illuminate\Support\Str::random(4); @endphp
<div x-data="{ open: 0 }" class="space-y-3">
                @foreach ($items as $i => $faq)
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden" data-reveal style="--i:{{ $i }}">
                        <h3>
                            <button type="button" x-on:click="open = open === {{ $i }} ? null : {{ $i }}"
                                :aria-expanded="(open === {{ $i }}).toString()" aria-controls="faq-{{ $uid }}-{{ $i }}"
                                class="w-full flex items-center justify-between gap-4 text-left px-5 py-4 font-semibold text-gray-800 hover:text-amber-700 transition-colors">
                                {{ $faq['q'] }}
                                <span class="shrink-0 w-8 h-8 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center transition-transform duration-300" :class="open === {{ $i }} ? 'rotate-45 bg-amber-600 text-white' : ''" aria-hidden="true">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14M5 12h14"/></svg>
                                </span>
                            </button>
                        </h3>
                        <div id="faq-{{ $uid }}-{{ $i }}" class="faq-panel" role="region" :data-open="(open === {{ $i }}).toString()">
                            <div><p class="px-5 pb-5 text-gray-600 leading-relaxed">{{ $faq['a'] }}</p></div>
                        </div>
                    </div>
                @endforeach
            </div>
