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

        protected function prepare_email_data ($user)
        {
            return array(
                'address' => "Joe Mcjoe\n30 The Grange\nLlandaff\nCardiff\nCF5 2LH",
                'date'    => date('d/m/Y'),
                'name'    => 'Joe McJoe',
            );
        }

		public function get_cheque ()
		{  
            // full size 202 units 
            $offset = array(
                'width' => 16,
                'height'=> 12
            );
            $data = $this->prepare_email_data();
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
            $pdf->AddPage();
            $pdf->SetFont(
                'courierb', 
                '', 
                12
            );
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
                "Current Date",
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
                "Full name",
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
                "Books sold and sum",
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
                "Cheque Date",
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
                "Cheque Name",
                0,
                'L',
                false,
                1,
                48 - $offset['width'],
                258 - $offset['height']
            );
            // Cheque Verbal Ammount
            $pdf->MultiCell(
                55,
                0,
                "Cheqye Verbal Ammount",
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
                "Cheque Actual Ammount",
                0,
                'L',
                false,
                1,
                181 - $offset['width'],
                258 - $offset['height']
            );

			ob_end_clean();
			$pdf->Output( OUTPUT . '/print_cheque.pdf', 'F');
		}

    public function get_cheques ()
    {
      return 'your cheques here';
    }

		protected function _get_tcpdf_files ()
		{
			require_once INNER . '/library/tcpdf/config/tcpdf_config.php';
			require_once INNER . '/library/tcpdf/tcpdf.php';
		}
          // $style = array(
          //       'position'     => '',
          //       'align'        => 'C',
          //       'stretch'      => false,
          //       'fitwidth'     => true,
          //       'cellfitalign' => '',
          //       'border'       => true,
          //       'hpadding'     => 'auto',
          //       'vpadding'     => 'auto',
          //       'fgcolor'      => array(0,0,0),
          //       'bgcolor'      => false, //array(255,255,255),
          //       'text'         => true,
          //       'font'         => 'helvetica',
          //       'fontsize'     => 8,
          //       'stretchtext'  => 4
          //   );

          //   $pdf->Cell(0, 0, 'CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9', 0, 1);
          //   $pdf->write1DBarcode(
          //       '124', // code
          //       'C39', // type
          //       '',    // x position
          //       '',    // y position 
          //       100,   // width 
          //       30,    // height 
          //       0.4,   // width of the smallest bar
          //       $style,// barcode style  
          //       'N'    // alignment
          //   );
	}
	
	
?>	