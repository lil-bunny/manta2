
function: get_php_tag
docstring: This function generates a PHP open tag "<?php" as a string.
purpose: This functionality is useful for software development as it allows for easy generation of a PHP open tag at the beginning of a file. This is necessary for any PHP code to be executed and is a common practice in web development. Using this function can save time and reduce errors when manually typing out the open tag. <?php

function: generateNamespaceCommand
docstring: This function generates a new namespace command class with the given name and adds it to the App\Console\Commands namespace.
purpose: This functionality allows developers to easily create new namespace commands for their Laravel application, making it easier to organize and manage different commands within the application. This can improve the overall structure and maintainability of the codebase.namespace App\Console\Commands;

function: Illuminate\Console\Command
docstring: This function is used to create a new command for the console application. It is an abstract class that must be extended by any custom command class.
purpose: This functionality is used to provide a standardized way of creating and executing custom commands in a console application. It allows developers to easily add new features and functionality to their console application without having to manually handle command line arguments and input. The use of this function promotes code reusability and maintainability in software development.use Illuminate\Console\Command;

function: get_areas
docstring: This function retrieves all areas from the database and returns them in a list.
purpose: This functionality allows for the retrieval of all areas in the database, which can be useful for displaying a list of available areas for users to select from. It also provides a way to easily access and manipulate area data within the software. use App\Models\Area;

function: Http
docstring: This function is used to make HTTP requests to a remote server.
purpose: In software development, the Http function allows developers to easily communicate with remote servers and retrieve data or perform actions. This is essential for creating web applications or integrating with external APIs. It abstracts away the complexities of handling HTTP requests and responses, making it easier for developers to focus on their application's logic. use Illuminate\Support\Facades\Http;
 function: AddPOI
  docstring: This command adds POI (point of interest) information to areas that have been onboarded. It uses an external API to fetch data based on latitude and longitude coordinates and adds the retrieved data to the corresponding area in the database.
  purpose: This functionality is useful for populating areas with relevant POI information, which can be used for various purposes such as creating personalized recommendations for users, improving search results, and enhancing the overall user experience. It is an important feature in software development, especially for location-based applications and services.class AddPOI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:poi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will add poi informations to the area onboarded';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Fetching the area data for adding the poi informations
        $area_list = Area::where('areas.is_deleted', '=', 0)->whereNull('areas.gridTrends')->get();
        

        // iterating the list data and calling the coordinate API
        $area_nof = [];
        foreach($area_list as $area_info) {
            $error = '';
            try {
                $this->info("Adding POI process started for ".$area_info->id);

                // calling the alternate data API with respect to lat and lang and api key
                $api_url = env('FETCH_POI_URL');
                $api_key = env('FETCH_POI_KEY');
                
                // setting the header
                $headers = [
                    'apikey' => $api_key
                ];

                // setting the post input
                $post_input = [
                    'lat' => $area_info->lat,
                    'lng' => $area_info->lng,
                ];
                
                // fetching the response
                $response = Http::withHeaders($headers)->post($api_url, $post_input);
                $statusCode = $response->status();
                $responseBody = json_decode($response->getBody(), true);
            
                
                $poi_data = [];
                if($statusCode == '201') {
                    $gridTrends = $responseBody['gridTrends'];

                    foreach($gridTrends as $key => $value) {
                        $poi_data[$key] = $value;
                    }
                } else {
                    $error = $responseBody['error'];
                    $area_nof[] = $area_info->id;
                    $this->info("Error occured during POI addition for the area ".$area_info->id);
                }

                // assigning data to object
                $area_info->gridTrends = $poi_data;
                $area_info->error_response = $error != ''?$error:'';
                $area_info->save();
                $this->info("POI addition completed for the area ".$area_info->id);
            } catch(\Exception $e) {
                $area_nof[] = $area_info->id;
                $area_info->error_response = $e->getMessage();
                $area_info->save();
            }
        }

        if(count($area_nof) > 0) {
            $this->info("Failed area ids ".implode(',', $area_nof));
        }
        
        $this->info("Operation completed successfully");
        return TRUE;
    }
}
