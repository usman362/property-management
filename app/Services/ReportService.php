<?php

namespace App\Services;
use App\Models\Apartment;
use App\Models\Repair;
use App\Models\Tenant;
use Carbon\Carbon;

class ReportService
{

    public function maintenance($request)
    {

        $year = request('year');
        $month = request('month');
        $apartment = request('apartment_id');

        $maintenance = Repair::when($year, function ($query) use ($year) {
            $query->whereYear('date', $year);
        })->when($month, function ($query) use ($month) {
            $query->whereMonth('date', Carbon::parse($month)->format('m'));
        })->when($apartment, function ($query) use ($apartment) {
            $query->where('apartment_id', $apartment);
        })->get();
        return datatables($maintenance)
            ->addIndexColumn()
            ->addColumn('apartment_name', function ($row) {
                return $row->apartment->apartment_name ?? '';
            })
            ->addColumn('status', function ($maintenance) {
                if ($maintenance->status == 'Checked Out') {
                    return '<div class="status-btn status-btn-green font-13 radius-4">' . __('Checked In') . '</div>';
                } else {
                    // return '<div class="status-btn status-btn-red font-13 radius-4">' . __('Pending') . '</div>';
                    return '<div class="status-btn status-btn-orange font-13 radius-4">' . __('Checked Out') . '</div>';
                }
            })
            ->rawColumns(['status'])
            ->make(true);
    }

    public function tenant()
    {
        $year = request('year');
        $month = request('month');
        $apartment = request('apartment_id');

        $tenants = Tenant::when($year, function ($query) use ($year) {
            $query->whereYear('check_in_date', $year)
                ->orWhereYear('check_out_date', $year)
                ->orWhereYear('contract_date', $year);
        })->when($month, function ($query) use ($month) {
            $query->whereMonth('check_in_date', $month)
                ->orWhereMonth('check_out_date', $month)
                ->orWhereMonth('contract_date', $month);
        })->when($apartment, function ($query) use ($apartment) {
            $query->where('apartment_id', $apartment);
        })->get();

        return datatables($tenants)
            ->addIndexColumn()
            ->addColumn('name', function ($tenant) {
                return $tenant->first_name . ' ' . $tenant->last_name;
            })
            ->addColumn('apartment_name', function ($tenant) {
                return $tenant->apartment->apartment_name ?? '';
            })

            ->rawColumns(['name', 'apartment_name'])
            ->make(true);
    }

    public function apartment()
    {
        $year = request('year');
        $month = request('month');

        $apartments = Apartment::when($year, function ($query) use ($year) {
            $query->whereYear('created_at', $year);
        })->when($month, function ($query) use ($month) {
            $query->whereMonth('created_at', $month);
        })->with(['repairs' => function ($query) use ($year, $month) {
            $query->when($year, function ($query) use ($year) {
                $query->whereYear('date', $year);
            })->when($month, function ($query) use ($month) {
                $query->whereMonth('date', $month);
            });
        }])->get();

        return datatables($apartments)
            ->addIndexColumn()
            ->addColumn('name', function ($apartment) {
                return $apartment->first_name . ' ' . $apartment->last_name;
            })
            ->addColumn('apartment_name', function ($apartment) {
                return $apartment->apartment->apartment_name ?? '';
            })

            ->rawColumns(['name', 'apartment_name'])
            ->make(true);
    }
}
