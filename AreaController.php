 function: convert_site_data
  docstring: Accepts site data and converts it to get the required information for the software.
  purpose: This functionality is used to convert site data into a format that can be easily used by the software. It helps in organizing and extracting the necessary information from the site data, making it easier to work with and reducing the time and effort required for data processing. $site_dtl[$sitekey]['value']= $site_merit_value->id;
                    $site_dtl[$sitekey]['label']= $site_merit_value->title;
                }
            }
                   
        }

        $poi_data = [];
        if(!empty($area_data->gridTrends)) {
            foreach($area_data->gridTrends as $key => $value) {
                if($value != '0' && $value != '') {
                    $poi_data[$key]['value'] = $value;
                    $poi_data[$key]['label'] = ucwords(str_replace('_', ' ', $key));
                }
            }
        } 


        if (count($poi_data) > 0){

            echo "<pre>"; print_r($poi_data); exit;
        }
  
    }*/
}
