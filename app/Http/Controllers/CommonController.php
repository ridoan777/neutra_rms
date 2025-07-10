<?php

namespace App\Http\Controllers;

use App\Models\AllRecords;
use App\Models\Party;
use App\Models\Project;
use App\Models\Record;
use Illuminate\Http\Request;

class CommonController extends Controller
{
	public function dashboard(){

		// $employees = $this->getRecord();
		$customers = Party::where('type', 'customer')->count();
		$suppliers = Party::where('type', 'supplier')->count();
		$admins = Party::where('type', 'admin')->count();
		$employees = Party::where('type', 'employee')->count();

		$invoiceAmnt = '৳'. ' ' . number_format( AllRecords::where('type', 'invoice')->sum('total'), 2);
		$receivedAmnt = '৳'. ' ' . number_format( AllRecords::sum('paid'), 2);
		$taxedAmnt = '৳'. ' ' . number_format( AllRecords::sum('tax'), 2);

		$expenseAmnt = '৳'. ' ' . number_format( AllRecords::where('type', 'expense')->sum('total'), 2);
		$duesAmnt = '৳'. ' ' . number_format( AllRecords::where('type', 'invoice')->sum('dues'), 2);

		return view('dashboard', compact(
			'customers', 'suppliers', 'admins', 'employees', 'invoiceAmnt', 'receivedAmnt', 'taxedAmnt', 'duesAmnt', 'expenseAmnt'
		));
	}
	// ---------------------------------
	private function getRecord(){
		$countEmployees = Party::where('type', 'employee')->count();

		return $countEmployees;
	}
	// ---------------------------------
	private function getTransaction(){
		$countEmployees = Party::where('type', 'employee')->count();

		return $countEmployees;
	}
	// ---------------------------------
	public function printArea($id){

		$singleRecord = Record::where('id', $id)->first();
		$fetchProjectDetails = Project::where('id', $singleRecord->p_id)->first(); //Record::p_id is actually Project::id

		return view('components.layouts.printarea', [
			'singleRecord' => $singleRecord,
			'fetchProjectDetails' => $fetchProjectDetails,
		]);
	}
	// ---------------------------------
}
