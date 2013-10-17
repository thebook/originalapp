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

		public function get_freepost ()
		{
			$this->_get_tcpdf_files();

            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetCreator(PDF_CREATOR);
            // $pdf->SetAuthor('Recyclabook');
            // $pdf->SetTitle('Freepost Pack');
            // $pdf->SetSubject('Freepost');
            // $pdf->SetHeaderData(
            //     PDF_HEADER_LOGO, 
            //     PDF_HEADER_LOGO_WIDTH, 
            //     PDF_HEADER_TITLE.' 027', 
            //     PDF_HEADER_STRING
            // );
            // $pdf->setHeaderFont(Array(
            //     PDF_FONT_NAME_MAIN, 
            //     '', 
            //     PDF_FONT_SIZE_MAIN)
            // );
            // $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
            $pdf->SetMargins(
                22, // left
                0,  // top
                22  // right
            );
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf->setLanguageArray($l);
            }
            $pdf->AddPage();
            $pdf->SetFont('helvetica', '', 10);        

            $pdf->MultiCell(
                // width,   
                40,
                // height,
                0,
                // text
                "Joe Mcjoe\n30 The Grange\nLlandaff\nCardiff\nCF5 2LH",
                // border L,T,R,B || 0,
                0,
                // align  L,R,C,J,
                'L',
                // fill (color),
                false,
                // line next 0:right, 1:begining of next line(default), 2:bellow,
                1,
                // x position,
                30,
                // y position,
                22
            );
            $pdf->MultiCell(
                40,
                0,
                "Dear Joe Mcjoe\nThank you for using Recyclabook to sell your books. We hope that the process was quick and easy",
                0,
                'L',
                false,
                1,
                100,
                22
            );

			ob_end_clean();
			$pdf->Output( OUTPUT . '/freepost.pdf', 'F');
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