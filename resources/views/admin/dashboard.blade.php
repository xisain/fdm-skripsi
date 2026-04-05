@extends('layout.admin')

@section('content')
<div class="p-2 space-y-6">
    <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div class="space-y-2">
            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-emerald-600">Garden inventory</p>
            <h1 class="text-3xl font-semibold text-slate-900">Flora Inventory</h1>
            <p class="max-w-2xl text-sm text-slate-500">Monitor plant stock, growth status, and greenhouse activity in a clean Flora-style dashboard.</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <button class="inline-flex items-center rounded-full bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-emerald-200 transition hover:bg-emerald-700">Add Plant</button>
            <button class="inline-flex items-center rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Export List</button>
        </div>
    </div>

    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-3xl border border-slate-200 bg-linear-to-br from-white via-slate-50 to-emerald-50 p-6 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Total Plants</p>
            <p class="mt-4 text-4xl font-semibold text-slate-900">1,234</p>
            <p class="mt-2 text-sm text-emerald-600">+12% since last week</p>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-linear-to-br from-white via-slate-50 to-sky-50 p-6 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Species in Stock</p>
            <p class="mt-4 text-4xl font-semibold text-slate-900">56</p>
            <p class="mt-2 text-sm text-sky-600">5 new species added</p>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-linear-to-br from-white via-slate-50 to-yellow-50 p-6 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Plants Ready</p>
            <p class="mt-4 text-4xl font-semibold text-slate-900">842</p>
            <p class="mt-2 text-sm text-yellow-600">+8% ready for delivery</p>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-linear-to-br from-white via-slate-50 to-rose-50 p-6 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Low Stock Alerts</p>
            <p class="mt-4 text-4xl font-semibold text-slate-900">23</p>
            <p class="mt-2 text-sm text-rose-600">2 alerts unresolved</p>
        </div>
    </div>

    <div class="grid gap-6 xl:grid-cols-[2fr_1fr]">
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-slate-900">Growth Trends</h2>
                    <p class="text-sm text-slate-500">Weekly growth for categories like succulents, ferns, and tropical plants.</p>
                </div>
                <span class="rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-700">+18%</span>
            </div>

            <div class="mt-8 space-y-4">
                <div class="h-48 rounded-3xl bg-slate-100 p-4">
                    <div class="relative h-full">
                        <div class="absolute inset-x-0 bottom-0 flex items-end justify-between gap-3 px-2">
                            <div class="h-12 w-full rounded-full bg-emerald-500/30"></div>
                            <div class="h-24 w-full rounded-full bg-emerald-500/50"></div>
                            <div class="h-20 w-full rounded-full bg-emerald-500/40"></div>
                            <div class="h-28 w-full rounded-full bg-emerald-500/70"></div>
                            <div class="h-16 w-full rounded-full bg-emerald-500/30"></div>
                            <div class="h-32 w-full rounded-full bg-emerald-500/60"></div>
                            <div class="h-24 w-full rounded-full bg-emerald-500/50"></div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-sm text-slate-500">New Arrivals</p>
                        <p class="mt-3 text-2xl font-semibold text-slate-900">124</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-sm text-slate-500">Healthy Rate</p>
                        <p class="mt-3 text-2xl font-semibold text-slate-900">93%</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-slate-900">Recent Activity</h2>
                    <p class="text-sm text-slate-500">Latest inventory updates and greenhouse actions.</p>
                </div>
                <button class="rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-700">See all</button>
            </div>

            <ul class="mt-6 space-y-4">
                <li class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                    <p class="text-sm font-semibold text-slate-900">Aloe Vera batch moved to display shelf</p>
                    <p class="mt-1 text-sm text-slate-500">2 minutes ago</p>
                </li>
                <li class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                    <p class="text-sm font-semibold text-slate-900">New shipment of Monstera Deliciosa arrived</p>
                    <p class="mt-1 text-sm text-slate-500">1 hour ago</p>
                </li>
                <li class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                    <p class="text-sm font-semibold text-slate-900">Low stock alert: Snake Plants running low</p>
                    <p class="mt-1 text-sm text-slate-500">3 hours ago</p>
                </li>
            </ul>
        </section>
    </div>
</div>
@endsection
