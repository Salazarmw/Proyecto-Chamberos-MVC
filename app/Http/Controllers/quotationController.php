<?php
// app/Http/Controllers/quotationController.php
namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Quotation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class quotationController extends Controller
{
    public function index()
    {
        $user = Auth::user(); 
        $quotations = [];

        if ($user->user_type === 'client') {
            
            $quotations = Quotation::where('client_id', $user->id)->get();
        } elseif ($user->user_type === 'chambero') {
            
            $quotations = Quotation::where('chambero_id', $user->id)->get();
        }

        return view('quotations.index', compact('quotations'));
    }

    public function create(Request $request, $chamberoId)
    {
        $clientId = $request->user()->id; // Current User id
        $chambero = User::findOrFail($chamberoId); // Chambero id

        return view('quotations.create', compact('clientId', 'chambero'));
    }

    public function store(Request $request)
    {

        //Log::info('Datos de la solicitud:', $request->all());

        // Validate data
        $validatedData = $request->validate([
            'client_id' => 'required|exists:users,id',
            'chambero_id' => 'required|exists:users,id',
            'service_description' => 'required|string|max:1000',
            'scheduled_date' => 'required|date|after_or_equal:today',
            'price' => 'required|string', 
        ]);

        try {
            // Create quotation
            $quotation = new Quotation();
            $quotation->client_id = $request->input('client_id');
            $quotation->chambero_id = $request->input('chambero_id');
            $quotation->service_description = $request->input('service_description');
            $quotation->scheduled_date = $request->input('scheduled_date');

            $price = str_replace(',', '', $request->input('price'));
            $quotation->price = floatval($price);

            $quotation->status = 'pending';

            $quotation->save();

            return redirect()->route('dashboard')->with('success', 'Cotización enviada correctamente');

        } catch (\Exception $e) {

            Log::error('Error al guardar la cotización: ' . $e->getMessage());

            // Redirect with an error message 
            return back()->withErrors(['msg' => 'Hubo un error al guardar la cotización: ' . $e->getMessage()]);
        }
    }

    public function accept($id)
    {
        $quotation = Quotation::findOrFail($id);

        $quotation->status = 'accepted';
        $quotation->save();

        $job = new Job();
        $job->quotation_id = $quotation->id;  
        $job->status = 'in_progress';  
        $job->save();  

        return response()->json(['message' => 'Cotización aceptada y Job creado con éxito.']);
    }

    public function reject($id)
    {
        $quotation = Quotation::findOrFail($id);
        $quotation->status = 'rejected'; 
        $quotation->save();

        return response()->json(['message' => 'Cotización rechazada con éxito.']);
    }

    public function updateCounteroffer(Request $request, $id)
    {
        $validatedData = $request->validate([
            'price' => 'required|numeric|min:0',
            'scheduled_date' => 'required|date|after_or_equal:today',
        ]);

        try {
            $quotation = Quotation::findOrFail($id);

 
            $quotation->price = $validatedData['price'];
            $quotation->scheduled_date = $validatedData['scheduled_date'];
            $quotation->status = 'offer'; 

            $quotation->save();

            return redirect()->route('dashboard')->with('success', 'Contraoferta enviada con éxito.');
        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'Error al enviar la contraoferta: ' . $e->getMessage()]);
        }
    }
}
