<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgentContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AgentContactController extends Controller
{
    public function index()
    {
        $agent = AgentContact::first();
        return view('admin.agent-contact.index', compact('agent'));
    }

    public function edit()
    {
        $agent = AgentContact::first();
        if (!$agent) {
            $agent = new AgentContact();
        }
        return view('admin.agent-contact.edit', compact('agent'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile_number' => 'required|string|max:20',
            'whatsapp_number' => 'required|string|max:20',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $agent = AgentContact::first();
        
        if (!$agent) {
            $agent = new AgentContact();
        }

        $data = $request->all();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($agent->photo && file_exists(public_path('images/agent/' . $agent->photo))) {
                unlink(public_path('images/agent/' . $agent->photo));
            }

            $photo = $request->file('photo');
            $filename = time() . '_' . Str::random(10) . '.' . $photo->getClientOriginalExtension();
            
            try {
                $photo->move(public_path('images/agent'), $filename);
                $data['photo'] = $filename;
            } catch (\Exception $e) {
                \Log::error('Agent photo upload failed: ' . $e->getMessage());
                return redirect()->back()
                               ->withInput()
                               ->with('error', 'Failed to upload photo. Please try again.');
            }
        }

        if ($agent->exists) {
            $agent->update($data);
            $message = 'Agent contact information updated successfully.';
        } else {
            $agent = AgentContact::create($data);
            $message = 'Agent contact information created successfully.';
        }

        return redirect()->route('admin.agent-contact.index')->with('success', $message);
    }
}