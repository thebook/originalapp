<?php
	/**
	* A pdf generation class
	*/
	class pdf_maker extends alpha
	{
		
		function __construct()
		{
			parent::__construct('pdf_maker');
		}

        public function get_cheque ($data)
        {  
            // full size 210 units 
            $offset = array(
                'width' => 16,
                'height'=> 12
            );
			$this->_get_tcpdf_files();
            $pdf = new TCPDF(
              'P', 
              'mm', 
              PDF_PAGE_FORMAT, 
              true, 
              'UTF-8', 
              false
            );
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
            $pdf->SetMargins(
                10, // left
                0,  // top
                10  // right
            );
            $pdf->SetHeaderMargin(0);
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf->setLanguageArray($l);
            }
            $pdf->SetFont(
                'courierb', 
                '', 
                12
            );
            foreach ($data as $cheque) {
            	$this->add_cheque_page($pdf, (array)$cheque, $offset);
            }

			ob_end_clean();
			$pdf->Output( OUTPUT . '/print_cheque.pdf', 'F');

			return OUTPUTURI .'/print_cheque.pdf';
		}

		public function get_freepost ($data)
        {  

			$this->_get_tcpdf_files();
			$table = new table_creator;
			$text  = $table->get_row('book_settings', 'name', 'pack_letter')['value'];
			print_r($text);
            $pdf = new TCPDF(
              'P', 
              'mm', 
              PDF_PAGE_FORMAT, 
              true, 
              'UTF-8', 
              false
            );
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
            $pdf->SetMargins( 10, 0, 10 );
            $pdf->SetHeaderMargin(0);
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf->setLanguageArray($l);
            }
            $pdf->SetFont(
                'courierb', 
                '', 
                12
            );
            foreach ($data as $freepost) {
            	$this->freepost_page($pdf, (array)$freepost, $text);
            }

			ob_end_clean();
			$pdf->Output( OUTPUT . '/print_freepost.pdf', 'F');

			return OUTPUTURI .'/print_freepost.pdf';
		}

		public function freepost_page ($pdf, $data, $text)
		{
            $pdf->AddPage();
            $pdf->Image(OUTER .'/css/include/old/CSS/Includes/works/header_logo.png', 110, 10, 80 );
            $this->create_bar_code($pdf, $data['id']);
            $pdf->MultiCell(
                200,
                0,
                $this->replace_placeholders_in_text_with_values( $data, $text ),
                0,
                'L',
                false,
                1,
                20,
                60
            );
        }

        public function replace_placeholders_in_text_with_values ($values, $text)
        {
        	return preg_replace(
				array(
					'/USER_NAME/',
					'/PRICE_PROMISE_SUM/',
					'/USER_ID/',
				),
				array(
					$values['name'],
					$values['sum'],
					$values['id']
				),
				$text
			);
        }

        public function add_cheque_page($pdf, $data, $offset)
        {
            $pdf->AddPage();
            // User Address 
            $pdf->MultiCell(
                55,
                0,
                $data['address'],
                0,
                'L',
                false,
                1,
                35 - $offset['width'],
                35 - $offset['height']
            );
            // Date
            $pdf->MultiCell(
                55,
                0,
                $data['date'],
                0,
                'L',
                false,
                1,
                175 - $offset['width'],
                85 - $offset['height']
            );
            // Full Name
            $pdf->MultiCell(
                55,
                0,
                $data['name'],
                0,
                'L',
                false,
                1,
                45 - $offset['width'],
                105 - $offset['height']
            );
            // Number of books sold and sum
            $pdf->MultiCell(
                55,
                0,
                "Number of books sold to us : {$data['books_sold_sum']}",
                0,
                'L',
                false,
                1,
                125 - $offset['width'],
                105 - $offset['height']
            );
            // Cheque date
            $pdf->MultiCell(
                55,
                0,
                $data['date'],
                0,
                'L',
                false,
                1,
                188 - $offset['width'],
                243 - $offset['height']
            );
            // Cheque Name
            $pdf->MultiCell(
                55,
                0,
                $data['name'],
                0,
                'L',
                false,
                1,
                48 - $offset['width'],
                258 - $offset['height']
            );
            // Cheque Verbal Ammount
            $pdf->MultiCell(
                110,
                0,
                $data['text_amount'],
                0,
                'L',
                false,
                1,
                48 - $offset['width'],
                267 - $offset['height']
            );
            // Cheque Actual Ammount
            $pdf->MultiCell(
                55,
                0,
                $data['number_amount'],
                0,
                'L',
                false,
                1,
                181 - $offset['width'],
                258 - $offset['height']
            );
        }

		protected function _get_tcpdf_files ()
		{
			require_once INNER . '/library/tcpdf/config/tcpdf_config.php';
			require_once INNER . '/library/tcpdf/tcpdf.php';
		}

		protected function create_bar_code ($pdf, $number)
		{
			$style = array(
                'position'     => '',
                'align'        => 'C',
                'stretch'      => false,
                'fitwidth'     => true,
                'cellfitalign' => '',
                'border'       => true,
                'hpadding'     => 'auto',
                'vpadding'     => 'auto',
                'fgcolor'      => array(0,0,0),
                'bgcolor'      => false, //array(255,255,255),
                'text'         => true,
                'font'         => 'helvetica',
                'fontsize'     => 8,
                'stretchtext'  => 4
            );
            $pdf->write1DBarcode(
                $number, // code
                'C39', // type
                20,    // x position
                10,    // y position 
                100,   // width 
                20,    // height 
                0.4,   // width of the smallest bar
                $style,// barcode style  
                'N'    // alignment
            );	
		}
	}
	
	
?>	