<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\OrderredCanvas;
use App\Models\OrderredCanvasCommonOption;

class ProcessOrders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $xml = simplexml_load_string(file_get_contents(public_path('alle_orders_stripped.xml')));

        $data = json_decode(json_encode($xml), true); 

        foreach($data as $raw_orders) {
            foreach($raw_orders as $raw_order) {
                $order = new Order();

                $order->user_id = (key_exists('user_id', $raw_order['@attributes']) ? $raw_order['@attributes']['user_id'] : 0);
                $order->foreign_order_id = $raw_order['@attributes']['id'];
                $order->order_nr = $raw_order['@attributes']['order_number'];

                $order->save();

                foreach($raw_order['canvas'] as $raw_canvas) {
                    $orderred_canvas = new OrderredCanvas();

                    $orderred_canvas->order_id = $order->id;
                    $orderred_canvas->canvass_id = 1; // Dummy, can be read from xml
                    $orderred_canvas->glass_handle_id = 1; // Dummy, can be read from xml
                    $orderred_canvas->width = $raw_canvas['@attributes']['width'];
                    $orderred_canvas->height = $raw_canvas['@attributes']['height'];
                    $orderred_canvas->inner_margin_vertical = $raw_canvas['inner_margin_vertical'];
                    $orderred_canvas->inner_margin_horizontal = $raw_canvas['inner_margin_horizontal'];;
                    $orderred_canvas->outer_margin_vertical = $raw_canvas['outer_margin_vertical'];;
                    $orderred_canvas->outer_margin_horizontal = $raw_canvas['outer_margin_horizontal'];;
                    $orderred_canvas->rabbet_id = 1; // Dummy, can be read from xml
                    $orderred_canvas->sill_id = 1; // Dummy, can be read from xml
                    $orderred_canvas->lacquer_id = 1; // Dummy, can be read from xml

                    $orderred_canvas->save();

                    foreach($raw_canvas['common_options'] as $raw_common_option) {
                        $common_option = new OrderredCanvasCommonOption();

                        // todo: add logic to search for a common option, if not found create one

                        $common_option->orderred_canvasses_id = $orderred_canvas->id;
                        $common_option->common_options_id = 1;

                        $common_option->save();
                    }

                    dd('--');
                }
            }

            dd('--');
        }
    }
}
