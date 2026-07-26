<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class ApiTester extends Component
{
    public $methods = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'];
    public $selectedMethod = 'GET';
    public $url = '';
    public $params = [''];
    public $headers = [''];
    public $response = null;
    public $status = null;
    public $loading = false;
    public $error = null;
    public $time = null;
    public $contentType = 'application/json';
    public $showRaw = false;

    protected $rules = [
        'url' => 'required|url',
        'selectedMethod' => 'required|in:GET,POST,PUT,PATCH,DELETE',
    ];

    public function mount()
    {
        // Initialize with one empty parameter field
        $this->params = [['key' => '', 'value' => '']];
        $this->headers = [['key' => '', 'value' => '']];
    }

    public function addParam()
    {
        $this->params[] = ['key' => '', 'value' => ''];
    }

    public function removeParam($index)
    {
        unset($this->params[$index]);
        $this->params = array_values($this->params);
    }

    public function addHeader()
    {
        $this->headers[] = ['key' => '', 'value' => ''];
    }

    public function removeHeader($index)
    {
        unset($this->headers[$index]);
        $this->headers = array_values($this->headers);
    }

    public function testApi()
    {
        $this->validate();
        
        $this->loading = true;
        $this->response = null;
        $this->error = null;
        $this->time = null;
        
        try {
            $startTime = microtime(true);
            
            // Prepare parameters
            $paramsArray = [];
            foreach ($this->params as $param) {
                if (!empty($param['key'])) {
                    $paramsArray[$param['key']] = $param['value'];
                }
            }

            // Prepare headers
            $headersArray = [
                'Accept' => 'application/json',
                'Content-Type' => $this->contentType,
            ];
            
            foreach ($this->headers as $header) {
                if (!empty($header['key']) && !empty($header['value'])) {
                    $headersArray[$header['key']] = $header['value'];
                }
            }

            // Make the request
            $client = Http::withHeaders($headersArray)->timeout(30);
            
            switch ($this->selectedMethod) {
                case 'GET':
                    $response = $client->get($this->url, $paramsArray);
                    break;
                case 'POST':
                    $response = $client->post($this->url, $paramsArray);
                    break;
                case 'PUT':
                    $response = $client->put($this->url, $paramsArray);
                    break;
                case 'PATCH':
                    $response = $client->patch($this->url, $paramsArray);
                    break;
                case 'DELETE':
                    $response = $client->delete($this->url, $paramsArray);
                    break;
                default:
                    throw new \Exception('Invalid method selected');
            }

            $endTime = microtime(true);
            $this->time = round(($endTime - $startTime) * 1000, 2); // in milliseconds
            
            $this->status = $response->status();
            $this->response = $response->json() ?? $response->body();

        } catch (RequestException $e) {
            $this->error = 'Request failed: ' . $e->getMessage();
            if ($e->response) {
                $this->status = $e->response->status();
                $this->response = $e->response->json() ?? $e->response->body();
            }
        } catch (\Exception $e) {
            $this->error = 'Error: ' . $e->getMessage();
        } finally {
            $this->loading = false;
        }
    }

    public function resetTest()
    {
        $this->reset(['response', 'status', 'error', 'time']);
    }

    public function clearAll()
    {
        $this->reset([
            'selectedMethod',
            'url',
            'params',
            'headers',
            'response',
            'status',
            'error',
            'time',
            'loading'
        ]);
        $this->params = [['key' => '', 'value' => '']];
        $this->headers = [['key' => '', 'value' => '']];
    }

    public function render()
    {
        return view('livewire.api-tester');
    }
}