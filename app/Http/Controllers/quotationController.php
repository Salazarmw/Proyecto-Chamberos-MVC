<?php
// app/Http/Controllers/quotationController.php
namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class quotationController extends Controller
{
    public function index()
{
    $userId = Auth::id(); // Obtener ID del usuario autenticado
    $quotations = Quotation::where('client_id', $userId)->get(); // Obtener cotizaciones del usuario
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
            'price' => 'required|string', // Cambiado a string para permitir comas
        ]);

        try {
            // Create quote
            $quotation = new Quotation();
            $quotation->client_id = $request->input('client_id');
            $quotation->chambero_id = $request->input('chambero_id');
            $quotation->service_description = $request->input('service_description');
            $quotation->scheduled_date = $request->input('scheduled_date');

            // delete the ","s and make the numbers decimals 10,2
            $price = str_replace(',', '', $request->input('price'));
            $quotation->price = floatval($price);

            $quotation->status = 'pending';

            // save quote
            $quotation->save();

            // Redirect with succesfull message 
            return redirect()->route('quotations.index')->with('success', 'Cotización enviada correctamente');
        } catch (\Exception $e) {
            
            Log::error('Error al guardar la cotización: ' . $e->getMessage());

            // Redirect with an error message 
            return back()->withErrors(['msg' => 'Hubo un error al guardar la cotización: ' . $e->getMessage()]);
        }
    }
}
